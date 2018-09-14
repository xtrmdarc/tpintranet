
$(function(){
    
    Dropzone.options.dzCargarServicios = {
        init: function() {

            this.on("sending",function(file){
                $('#mdl-carga-servicios').modal('show');
            });

            this.on("success", function(response) { 
                $("#mdl-carga-servicios-title").text('Carga completada con éxito');
                $("#respuesta_servicios_success").css('display','block');
                $("#servicios_carga_loader").css('display','none');
                $("#id_carga").val(response.carga_id);
            });
        }

      };

})
/*
$('#frm_guardar_carga').on('submit',function(e){
    e.preventDefault();
    var form = $(e.target);
   
    $.ajax({
        data: form.serialize(),
        url:   form.attr('action'),
        type:  'POST',
        dataType: 'json',
        dataSrc:"",
        headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(data) {
            alert('todo salio bien');
        }
    });
    return false;
   
});
*/