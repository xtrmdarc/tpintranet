var flota_table;

$(function(){

});

function detalle_piloto(id_piloto){
    
    $('#mdl-detalle-piloto').modal('show');
    $('#servicios_carga_loader').css('display','block');
    $('#content-detalle').css('display','none');
    $.ajax({
        data: {
            id_piloto : id_piloto
        },
        url:   '/Administracion/DetallePiloto',
        type:  'POST',
        dataType: 'json',
        dataSrc:"",
        headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(detalle) {
            $('#servicios_carga_loader').css('display','none');
            asigna_datos_modal_detalle_piloto(detalle);
            $('#content-detalle').css('display','block');
            
            
        }
    });
}

function asigna_datos_modal_detalle_piloto(detalle_piloto){
    
    
    for(var key in detalle_piloto){
        if(detalle_piloto[key]== null)
        detalle_piloto[key] = 'No definido';
    }
    console.log(detalle_piloto);
    //Conductor
    $('#mdl-txt-nombre-conductor').text(detalle_piloto.NombreConductor);
    $('#mdl-txt-tipo-piloto').text(detalle_piloto.DescTipoConductor);
    $('#mdl-txt-tipo-asociacion').text(detalle_piloto.DescTipoAsociacion);
    $('#mdl-txt-turno').text(detalle_piloto.DescTurno);
    $('#mdl-txt-estado').text(detalle_piloto.Estado);
    $('#mdl-txt-inactividad').text(detalle_piloto.Inactividad+' semanas');
    
    //Vehiculo
    $('#mdl-txt-placa').text(detalle_piloto.Placa);
    $('#mdl-txt-tipo-soat').text(detalle_piloto.DescSoat);
    $('#mdl-txt-fecha-soat').text(detalle_piloto.FechaVencSoat);
    $('#mdl-txt-fecha-tecnica').text(detalle_piloto.FechaVencRTecnica);
    
}

$("#ac_movil").autocomplete({
    delay: 1,
    autoFocus: true,
    source: function (request, response) {
        $.ajax({
            url: '/BuscarMovilAC',
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
       $('#ac_movil').val(ui.item.label);
       $('#ac_movil_id').val(ui.item.value);
    },
    change: function() {
        if($('#ac_movil').val() == '')
            $('#ac_movil_id').val('');
    }
});

$('#frm-buscar-flota').on('submit',function(e){
    e.preventDefault();
    e.stopImmediatePropagation();
    var form = $(e.target);

    $.ajax({
        url: form.attr('action'),
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        dataType: "json",
        data: form.serialize(),
        success: function (flota) {
            console.log(flota);
            flota_table.destroy(false);
            $('#table_flota tbody').empty();
            var lista_flota_html = ``;
            $.each(flota,function(k,v){
                lista_flota_html += `<tr>
                                        <td>${v.IdVehiculo}</td>
                                        <td>${v.NombreConductor}</td>
                                        <td>${v.DescTipoConductor}</td>
                                        <td class="text-center" >
                                            <span class="label label-${v.Estado=='Activo'?'success':'danger'} sticker-tabla">${v.Estado}</span>
                                        </td>
                                        <td class="text-center" >${v.Inactividad}</td>
                                        <td class="text-center"  ><button class="btn btn-primary" onclick="detalle_piloto(${'\''+ v.IdConductorSistema+'\''})" >Detalles</button></td>
                                    </tr>`;
            });
            $('#table_flota tbody').append(lista_flota_html);
            
            flota_table =  $('#table_flota').DataTable({
                'searching':false,
                'language':{
                    url:'//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json'
                } 
              });
        }
    })
});