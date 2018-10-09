$(function(){

});

function detalle_piloto(id_piloto){
    
    $('#mdl-detalle-piloto').modal('show');
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