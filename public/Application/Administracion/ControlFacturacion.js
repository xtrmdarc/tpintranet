var clientes_facturar=[];

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
    cliente_obj.igv = cliente_obj.subtotal*0.17;
    cliente_obj.total = cliente_obj.subtotal*1.17;

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
    $('#cliente_cb').val(cliente_seleccionado.IdCliente);
    $('#cliente_cb').selectpicker('refresh');
    $('#comprobante_cb').val(1);
    $('#es_credito').val(1);
    $('#id_cliente').val(cliente_seleccionado.IdCliente);
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
    var identificador_comprobante = $('#identificador_comprobante').val();
    if(esCredito == 1){
        
        var cliente_a_procesar = clientes_facturar.find(c=> c.IdCliente == id_cliente );
        var servicios = cliente_a_procesar.servicios;
        if(tipo_comprobante == 1){
            
        }
        else{
    
        }
        $.ajax({
            data: {
                MontSubTotal:  cliente_a_procesar.subtotal,
                MontIgv: cliente_a_procesar.igv ,
                MontTotal: cliente_a_procesar.total,
                IdCliente: cliente_a_procesar.IdCliente,
                IdTipoComprobante: tipo_comprobante,
                Identificador: identificador_comprobante,
                servicios: servicios
                
            },
            url:   '/Administracion/ProcesarComprobante',
            type:  'POST',
            dataType: 'json',
            dataSrc:"",
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            success: function(data) {
                if(data == 1)
                {
                    
                }
                else alert('error contactese con el administrador');
            }
        });
    }
    else{

    }
    

});


/*
function procesarComprobante()
{
    $esCredito = $('#es_credito').val();

    if(esCredito == 1){

    }
}*/