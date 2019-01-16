$(function(){

});

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

$('#frm-buscar-cliente').on('submit',function(event){
    event.preventDefault();
    event.stopImmediatePropagation();   
    if(!$('#ac_cliente_id').val()){
        
        return;
    }
    else
    {
        $.ajax({
            url: '/Administracion/Clientes/BuscarClienteXId',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            dataType: "json",
            data: {
                ac_cliente_id : $('#ac_cliente_id').val()

            },
            success: function (data) {
              
               var clientes_html = ``;
               data.forEach(cliente => {
                    var row_cliente = `
                                        <tr>
                                            <td>${cliente.IdCliente}</td>
                                            <td>${cliente.RUC?cliente.RUC:''}</td>
                                            <td>${cliente.NombreCliente}</td>
                                            <td class="text-center"  >
                                            <button class="btn btn-primary" style="display:none;" onclick="detalle_cliente(${cliente.IdClienteSistema})" >Detalles</button>
                                            <a class="btn btn-success" href="/Administracion/Clientes/Editar/${cliente.IdClienteSistema}" >Editar</a>
                                            </td>
                                        </tr>
                    `;

                   clientes_html+= row_cliente;
               });
               $('#table_cliente tbody').empty();
               $('#table_cliente').append(clientes_html);
            }
        })
    }
    

});