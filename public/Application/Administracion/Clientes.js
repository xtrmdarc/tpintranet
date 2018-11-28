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