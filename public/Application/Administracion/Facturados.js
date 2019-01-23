var facturados =[];
$(function(){
    
    $("#ac_cliente").autocomplete({
        delay: 1,
        autoFocus: true,
        source: function (request, response) {
            $.ajax({
                url: '/BuscarClientesAC',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                dataType: "json",
                data: {
                    criterio: request.term
                },
                success: function (data) {
                    console.log(data);
                    response($.map(data, function (item) {
                        return {
                            label: item.label,
                            value: item.value
                        }
                    }))
                }
            })
        },
        select: function (e, ui) {
            console.log(ui);
            e.preventDefault();
            
            //comboUnidadMedida(ui.item.cod_g);
            /*
            $('#cod_med option[value="'+ui.item.id_med+'"]').prop('selected', true);
            $('#insumo').text(ui.item.nombre);
            $('#ins_cod').val(ui.item.id);
            $('#desc_m').text(ui.item.desc_m);
            $('.list-ins').css('display','block');
            $('#b_insumo').val('');
            $('#b_insumo').focus();
            $('#ins_cant').val('');
            */
           $('#ac_cliente').val(ui.item.label);
           $('#ac_cliente_id').val(ui.item.value);
        },
        change: function() {
            if($('#ac_cliente').val() == '')
                $('#ac_cliente_id').val('');
        }
    })
    
    $('#btn_buscar_facturados').on('click',function(){
        $('#facturados_carga_loader').css('display','block');
        console.log();
        $.ajax({
            url: '/Administracion/BuscarFacturados',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: {
                id_cliente: $('#ac_cliente_id').val(),
                start_date : $('#periodo_facturados').data('daterangepicker').startDate.format('DD/MM/YY'),
                end_date : $('#periodo_facturados').data('daterangepicker').endDate.format('DD/MM/YY')
                
            },
            success: function (data) {
                console.log(data);
                $('#facturados_carga_loader').css('display','none');
                
                var facturados_html = ``;
                
                data.forEach(facturado => {
                    facturados_html += `<tr class="tr_comprobante_row" onclick="comprobante_detalle(${facturado.IdComprobante})" >
                                            <td>${facturado.FechaEmitido}</td>
                                            <td>${facturado.Identificador}</td>
                                            <td>${facturado.DescTipoComprobante}</td>
                                            <td class="text-right">${facturado.MontSubTotal}</td>
                                            <td class="text-right">${facturado.MontIgv}</td>
                                            <td class="text-right">${facturado.MontTotal}</td>
                                        </tr>`;
                    facturados.push(facturado);
                });
                $('#tabla_facturados tbody').empty();
                $('#tabla_facturados tbody').append(facturados_html);
            }
        });
    });


});
function comprobante_detalle(id_comprobante)
{   
    $('#table-mdl-comprobante tbody').empty();
    $('#facturados_detalle_carga_loader').css('display','block');
    $('#cp_cred_mdl_subtotal').text('S/. 0.00') ;
    $('#cp_cred_mdl_igv').text('S/. 0.00' );
    $('#cp_cred_mdl_total').text('S/. 0.00' );
    var facturado_actual  = facturados.find(f => f.IdComprobante == id_comprobante);
    $('#id_cliente').val(id_cliente);
    $('#id_comprobante').val(id_comprobante);
    $('#mdl-servicios-factura').modal('show');
    $('#mdl-servicios-factura-title').text(facturado_actual.Identificador+' -  '+ facturado_actual.FechaEmitido);

    $.ajax({
        url: '/Administracion/BuscarServiciosXComprobante',
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        dataType: "json",
        data: {
            id_comprobante: id_comprobante
        },
        success: function (data) {
            console.log(data);
            
            
            var facturados_detalle_html = ``;
            
            data.forEach(facturado => {
                facturados_detalle_html += `<tr>
                                        <th>${facturado.NumVale}</th>
                                        <th>${facturado.FechaServicio}</th>
                                        <th style="width:30%">${facturado.NombreUsuario}</th>
                                        <th></th>
                                        <th class="text-right" >${(parseFloat(facturado.MontContado)+parseFloat(facturado.MontTotalCredito)).toFixed(2)}</th>
                                    </tr>`;

            });
            
            $('#table-mdl-comprobante tbody').empty();
            $('#table-mdl-comprobante tbody').append(facturados_detalle_html);
            $('#cp_cred_mdl_subtotal').text('S/. ' +facturado_actual.MontSubTotal);
            $('#cp_cred_mdl_igv').text('S/. ' +facturado_actual.MontIgv);
            $('#cp_cred_mdl_total').text('S/. ' +facturado_actual.MontTotal);
            $('#facturados_detalle_carga_loader').css('display','none');
            $('#table-mdl-comprobante').css('display','block');
        }
    });

}