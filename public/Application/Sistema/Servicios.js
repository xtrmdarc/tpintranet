$(function(){

});

function setIdEmpresaXServicio(event,idservicio, idempresa ){

    $(event.target).toggleClass('btn-text-selected');

    $.ajax({
        data: {
            IdServicio : idservicio,
            IdEmpresa: idempresa
        },
        url:   '/Sistema/AsignarEmpresaServicio',
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