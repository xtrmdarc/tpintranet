var clientes_facturar=[];
var grupos_facturar_cont =[];
var igv; 
$(function(){
    //$('.selectpicker').selectpicker();
});

function CargarClientesFacturar(clientesFacturar){
    console.log(clientesFacturar.length);
    for(var i = 0; i< clientesFacturar.length; i++){

        var cliente_facturar = clientesFacturar[i];
        cliente_facturar.div_cliente =  'cf-cred-cliente-'+cliente_facturar.IdCliente;
        cliente_facturar.checkbox = 'cf_cred_cliente_checkbox_'+cliente_facturar.IdCliente;
        cliente_facturar.btn_procesar = 'cf_cred_btn_procesar_'+cliente_facturar.IdCliente;
        cliente_facturar.subtotal = 0.00;
        cliente_facturar.igv = 0.00;
        cliente_facturar.total = 0.00;

        cliente_facturar.subtotal_html = 'cf_cred_subtotal_'+cliente_facturar.IdCliente;
        cliente_facturar.igv_html = 'cf_cred_igv_'+cliente_facturar.IdCliente;
        cliente_facturar.total_html = 'cf_cred_total_'+cliente_facturar.IdCliente;
        console.log('en cliente' +cliente_facturar);
        clientes_facturar.push(clientesFacturar[i]); 
        
        for(var j = 0; j < cliente_facturar.servicios.length; j++)
        {
            cliente_facturar.servicios[j].checkbox = 'cf_cred_serv_checkbox_'+cliente_facturar.servicios[j].IdServicioSistema;
            
            

            //$('#'+cliente_facturar.servicios[j].checkbox).on('click',servicio_checked(i,j)) ;

        }


        
    }
    console.log(clientes_facturar);
}

function servicio_checked(x,y){
    
    var cliente_obj = clientes_facturar.find(p=> p.IdCliente == x);
    var servicio_obj = cliente_obj.servicios.find(s=> s.IdServicioSistema == y);
    if($('#'+servicio_obj.checkbox).is(':checked') ==true){
        cliente_obj.subtotal += parseFloat(servicio_obj.MontTotalCredito);
        servicio_obj.checked = true;
    }
    else{
        cliente_obj.subtotal -= parseFloat(servicio_obj.MontTotalCredito);  
        servicio_obj.checked = false;
    }

    cliente_obj.subtotal = Math.abs(cliente_obj.subtotal*1.00);
    cliente_obj.igv = cliente_obj.subtotal*igv;
    cliente_obj.total = cliente_obj.subtotal*(1+igv);

    $('#'+cliente_obj.subtotal_html).text('S/. '+ cliente_obj.subtotal.toFixed(2));
    $('#'+cliente_obj.igv_html).text('S/. '+ cliente_obj.igv.toFixed(2));
    $('#'+cliente_obj.total_html).text('S/. '+ cliente_obj.total.toFixed(2));
    
}

function cliente_checked(id_cliente){

    var cliente_obj = clientes_facturar.find(p=> p.IdCliente == id_cliente);
    var cliente_checkbox_checked = $('#'+cliente_obj.checkbox).is(':checked');
    
    if(cliente_checkbox_checked == true ){
        cliente_obj.subtotal = 0.00;
        cliente_obj.total = 0.00;
        cliente_obj.igv = 0.00;
        cliente_obj.servicios.forEach(el => {
            $('#'+el.checkbox).prop('checked',cliente_checkbox_checked);
            console.log($('#'+el.checkbox).is(':checked'));
            servicio_checked(id_cliente,el.IdServicioSistema);
        });    
    }
    else 
    {
        cliente_obj.servicios.forEach(el => {
            if($('#'+el.checkbox).is(':checked') == true){
                $('#'+el.checkbox).prop('checked',cliente_checkbox_checked);    
                servicio_checked(id_cliente,el.IdServicioSistema);
            }
        });  
    }
}

function preProcesarComprobanteCredito(id_cliente){
    var cliente_seleccionado =clientes_facturar.find(p=> p.IdCliente == id_cliente );
    var servicios_seleccionados = (clientes_facturar.find(c=> c.IdCliente == id_cliente )).servicios.filter(s=> s.checked == true);
    $('#mdl-procesar-comprobante').modal('show');
    console.log(cliente_seleccionado);
    
    $('#btn-mdl-procesar-cerrar').attr('onclick','window.location.replace("/Administracion/CFacturacion")');
    $('#btn-mdl-procesar-cerrar').attr('data-dismiss','');

    $('#div_cliente_cb').css('display','block');
    $('#cliente_cb').prop('required',true);
    $('#cliente_cb').val(cliente_seleccionado.IdCliente);
    $('#cliente_cb').selectpicker('refresh');
    $('#comprobante_cb').val(1);
    $('#es_credito').val(1);
    $('#id_cliente').val(cliente_seleccionado.IdCliente);
    //Reset form state
    $('#igv_cb').prop('checked',true).change();
    $('#dv_btn_exportar_excel').css('display','none');
    $('#cf_cred_btn_procesar').css('display','block');
    $('#cf_cred_btn_procesar').prop('disabled',false);
    var servicios_seleccionados_html = ``;
    $('#table-mdl-comprobante tbody').empty();
    servicios_seleccionados.forEach(servicio => {
        
        servicios_seleccionados_html += `<tr>
                                            <td>${servicio.NumVale}</td>  
                                            <td>${servicio.FechaServicio}</td>
                                            <td>${servicio.NombreUsuario}</td>
                                            <td></td>
                                            <td class="text-right" >${'S/. '+servicio.MontTotalCredito}</td>
                                        </tr>`;
    });
    //console.log('#cf_cred_mdl_subtotal_'+cliente_seleccionado.IdCliente);
    $('#cf_cred_mdl_subtotal').text('S/. ' +cliente_seleccionado.subtotal.toFixed(2));
    $('#cf_cred_mdl_igv').text('S/. ' +cliente_seleccionado.igv.toFixed(2));
    $('#cf_cred_mdl_total').text('S/. ' +cliente_seleccionado.total.toFixed(2));
    $('#table-mdl-comprobante tbody').append(servicios_seleccionados_html);   
}

$('#frm-procesar-comprobante').on('submit',function(event){
    event.preventDefault();
    event.stopImmediatePropagation();
    var form = $(event.target);
    var esCredito = $('#es_credito').val();
    var tipo_comprobante = $('#comprobante_cb').val();
    var id_cliente = $('#id_cliente').val();
    var id_grupo = $('#id_grupo').val();
    var igv_exon = $('input[name=igv_exon]:checked').val();
    var identificador_comprobante = $('#identificador_comprobante').val();
    var entidad_procesar ;
    var servicios_seleccionados;
    //var sentData = {id_grupo: id_grupo};
    $('#cf_cred_btn_procesar').prop('disabled',true);
    if(esCredito == 1){
        
        entidad_procesar = clientes_facturar.find(c=> c.IdCliente == id_cliente );
        servicios_seleccionados = (clientes_facturar.find(c=> c.IdCliente == id_cliente )).servicios.filter(s=> s.checked == true);
        if(tipo_comprobante == 1){
            
        }
        else{
           
        }
        
    }
    else if(esCredito==0){

        entidad_procesar = grupos_facturar_cont.find(g=> g.id == id_grupo );
        servicios_seleccionados = (grupos_facturar_cont.find(g=> g.id == id_grupo )).servicios;

        if(tipo_comprobante == 1){
            
        }
        else{
           
        }
    }

    $.ajax({
        data: {
            MontSubTotal:  entidad_procesar.subtotal,
            MontIgv: entidad_procesar.igv ,
            MontTotal: entidad_procesar.total,
            IdCliente: esCredito ==1 ? entidad_procesar.IdCliente:0,
            IdTipoComprobante: tipo_comprobante,
            Identificador: identificador_comprobante,
            IgvExon: igv_exon,
            servicios: servicios_seleccionados
        },
        url:   '/Administracion/ProcesarComprobante',
        type:  'POST',
        dataType: 'json',
        dataSrc:"",
        headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(respuesta) {
            console.log(id_grupo);
            console.log(esCredito);
            //console.log(grupos_facturar_cont[sentData.id_grupo]);
            if(respuesta.cod == 1)
            {
                //$('#mdl-procesar-comprobante').modal('hide');
                if(esCredito == 0)
                {
                    $('#'+grupos_facturar_cont[id_grupo].div_grupo_html).remove();
                }
                $('#dv_btn_exportar_excel').css('display','block');
                $('#cf_cred_btn_procesar').css('display','none');
                $('#id_comprobante').val(respuesta.id_comprobante);                
            }
            else alert('error contactese con el administrador');
        }
    });
    
});

$('input[name="igv_exon"').on('change',function(event){
    var cb = $(event.target);
    var cb_id = cb.attr('id');
    var id_tipo_comprobante = $('#comprobante_cb').val();
    if(id_tipo_comprobante == 1)
    {
        var id_cliente = $('#id_cliente').val();
        var cliente_seleccionado = clientes_facturar.find(c=>c.IdCliente == id_cliente);
        if(cb_id == 'igv_cb')
        {
            $('#tr_subtotal_pro_fact').css('visibility','visible');
            $('#tr_igv_pro_fact').css('visibility','visible');
            
            cliente_seleccionado.igv = cliente_seleccionado.subtotal*(igv);
            cliente_seleccionado.total = cliente_seleccionado.subtotal*(1+igv);
            $('#cf_cred_mdl_total').text('S/. ' +cliente_seleccionado.total.toFixed(2));
        }
        else if(cb_id == 'exonerado_cb')
        {
            $('#tr_subtotal_pro_fact').css('visibility','hidden');
            $('#tr_igv_pro_fact').css('visibility','hidden');
        
            cliente_seleccionado.igv = 0;
            cliente_seleccionado.total = cliente_seleccionado.subtotal;
            $('#cf_cred_mdl_total').text('S/. ' +cliente_seleccionado.total.toFixed(2));
        }
    }
    else if(id_tipo_comprobante==2)
    {
        var id_grupo = $('#id_grupo').val();
        var grupo_seleccionado = grupos_facturar_cont.find(g => g.id == id_grupo);
        if(cb_id == 'igv_cb')
        {
            $('#tr_subtotal_pro_fact').css('visibility','visible');
            $('#tr_igv_pro_fact').css('visibility','visible');
            
            grupo_seleccionado.igv = grupo_seleccionado.subtotal*(igv);
            grupo_seleccionado.total = grupo_seleccionado.subtotal*(1+igv);
            $('#cf_cred_mdl_total').text('S/. ' +grupo_seleccionado.total.toFixed(2));
        }
        else if(cb_id == 'exonerado_cb')
        {
            $('#tr_subtotal_pro_fact').css('visibility','hidden');
            $('#tr_igv_pro_fact').css('visibility','hidden');
            
            grupo_seleccionado.igv = 0;
            grupo_seleccionado.total = grupo_seleccionado.subtotal;
            $('#cf_cred_mdl_total').text('S/. ' +grupo_seleccionado.total.toFixed(2));
        }
    }
        
});

$('#frm-contado-facturacion-buscar').on('submit',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    var form = $(e.target);
    $.ajax({
        url: '/Administracion/BuscarServiciosContado',
        data: {
            start_date : $('#periodo_contados').data('daterangepicker').startDate.format('DD/MM/YY'),
            end_date : $('#periodo_contados').data('daterangepicker').endDate.format('DD/MM/YY')
        },
        type: 'POST',
        dataType: 'json',
        headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(grupos){

            CargarGruposFacturacionContado(grupos);
    
        }
    });
});

function CargarGruposFacturacionContado(grupos){

    grupos_facturar_cont = grupos;
    
    
    var grupos_facturar_html = ``;
    for(var i = 0; i< grupos_facturar_cont.length ; i++ )
    {
        var servicios_facturar_cont = ``;
        for(var j = 0; j< grupos_facturar_cont[i].servicios.length; j++)
        {
            servicios_facturar_cont+= ` <tr>
                                            <td>${grupos_facturar_cont[i].servicios[j].NumVale} </td>  
                                            <td>${grupos_facturar_cont[i].servicios[j].FechaServicio}</td>
                                            <td> ${grupos_facturar_cont[i].servicios[j].NombreUsuario}</td>
                                            <td></td>
                                            <td class="text-right" > ${'S/. ' +grupos_facturar_cont[i].servicios[j].MontContado} </td>
                                        </tr>`;
            //console.log(grupos_facturar_cont[i].servicios[j]);
        }
        grupos_facturar_cont[i].subtotal = grupos_facturar_cont[i].suma_total;
        grupos_facturar_cont[i].igv = 0;
        grupos_facturar_cont[i].total = grupos_facturar_cont[i].subtotal;
        grupos_facturar_cont[i].id = i;

        //asignar htmls
        grupos_facturar_cont[i].div_grupo_html = 'cf-cont-grupo-'+i;
        grupos_facturar_html += 
            `
            <div id="cf-cont-grupo-${i}" class="cf-cred-cliente row"   >    
                <a  data-toggle="collapse" href="#cf-cont-body-${i}">
                    <div class="cf-cred-cliente-header col-xs-12">
                        <h2 class="title">Servicios Varios ${i+1}</h2>
                        <p class="text-secondary-gray" style="display:inline-block">${grupos_facturar_cont[i].servicios.length } servicios por facturar</p> 
                    </div>
                </a>
                
                <div id="cf-cont-body-${i}" class="cf-cred-cliente-body collapse" >
                    <table class="table clearfix ">
                        <thead>
                        <tr>
                            <th>Num. Vale</th>
                            <th>Fecha Servicio</th>
                            <th style="width:40%">Usuario</th>
                            <th></th>
                            <th class="text-right" >Monto</th>

                        </tr>
                        </thead>
                            
                        <tbody >`+
                        servicios_facturar_cont
                            +`
                        </tbody>
                        <tfoot>
                            <tr style="visibility:hidden">
                                <td ></td>  
                                <td></td>
                                <td></td>
                                <td><b>Sub Total</b></td>
                                <td id="cf_cont_subtotal_${i}"   class="text-right" >S/. ${grupos_facturar_cont[i].subtotal.toFixed(2)}</td>
                                <td></td>
                            </tr>
                            <tr style="visibility:hidden">
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td ><b>IGV</b></td>
                                <td id="cf_cont_igv_${i}"  style="visibility:hidden" class="text-right" >S/. ${grupos_facturar_cont[i].igv.toFixed(2)}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td ><b>Total</b></td>
                                <td id="cf_cont_total_${i}" class="text-right" >S/. ${grupos_facturar_cont[i].total.toFixed(2)}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>  
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right" > <button class="btn btn-primary" id="cf_cont_btn_procesar_${i}" style="margin:0px;" value="Procesar" onclick="preProcesarComprobanteContado(${i})">Procesar</button> </td> 
                                <td></td>
                            </tr>
                        </tfoot>
                        
                    </table>
                    
                </div>
            </div>    
            `;

        servicios_facturar_cont = ``;

    }
    $('#cf-cont-grupos-div').empty();
    $('#cf-cont-grupos-div').append(grupos_facturar_html);
    
}

function preProcesarComprobanteContado(id_grupo){
    var grupo_seleccionado =grupos_facturar_cont.find(g=> g.id == id_grupo );
    var servicios_seleccionados = (grupos_facturar_cont.find(g=> g.id == id_grupo )).servicios;
    $('#mdl-procesar-comprobante').modal('show');
    $('#btn-mdl-procesar-cerrar').attr('onclick','');
    $('#btn-mdl-procesar-cerrar').attr('data-dismiss','modal');
    //console.log(cliente_seleccionado);
    //$('#cliente_cb').val(cliente_seleccionado.IdCliente);
    $('#div_cliente_cb').css('display','none');
    $('#cliente_cb').prop('required',false);
    //$('#cliente_cb').selectpicker('refresh');
    $('#comprobante_cb').val(2);
    $('#es_credito').val(0);
    $('#id_grupo').val(id_grupo);
    //$('#id_cliente').val(cliente_seleccionado.IdCliente);
    //Reset form state
    $('#exonerado_cb').prop('checked',true).change();
    $('#dv_btn_exportar_excel').css('display','none');
    $('#cf_cred_btn_procesar').css('display','block');
    $('#cf_cred_btn_procesar').prop('disabled',false);
    var servicios_seleccionados_html = ``;
    $('#table-mdl-comprobante tbody').empty();
    servicios_seleccionados.forEach(servicio => {
        
        servicios_seleccionados_html += `<tr>
                                            <td>${servicio.NumVale}</td>  
                                            <td>${servicio.FechaServicio}</td>
                                            <td>${servicio.NombreUsuario}</td>
                                            <td></td>
                                            <td class="text-right" >${'S/. '+servicio.MontContado}</td>
                                        </tr>`;
    });
    //console.log('#cf_cred_mdl_subtotal_'+cliente_seleccionado.IdCliente);
    /*
    $('#cf_cred_mdl_subtotal').text('S/. ' +grupo_seleccionado.subtotal.toFixed(2));
    $('#cf_cred_mdl_igv').text('S/. ' +grupo_seleccionado.igv.toFixed(2));
    $('#cf_cred_mdl_total').text('S/. ' +grupo_seleccionado.total.toFixed(2));
    */
    $('#table-mdl-comprobante tbody').append(servicios_seleccionados_html);   
}


/*
function procesarComprobante()
{
    $esCredito = $('#es_credito').val();

    if(esCredito == 1){

    }
}*/