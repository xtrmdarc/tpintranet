
$(function(){
    Dropzone.options.dzCargarServicios = {
        init: function() {

            this.on("sending",function(file,xhr,formData){
                modalCargaSetup();
                //formData.append('fechas',$('#periodo_descuentos').val());
            });

            this.on("success", function(file,response) { 
                var respuesta = JSON.parse(response);
                var html_respuesta = ``;


                if(respuesta.numFilas>0)
                {
                    html_respuesta = `
                    
                        <input id="id_carga" name="id_carga" type="hidden" value="${respuesta.carga_id}" >
                        <input type="hidden" name="_token" value="`+$('meta[name="csrf-token"]').attr('content')+`">
                        <div class="form-group " >
                        
                            <label class="col-form-label">Descuentos cargados</label>
                            <p class="form-control-static text-center text-primary" id="servicios_cargados_txt" style="font-size:1.9em;"  >${respuesta.numFilas}</p>
                            
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%;margin-top:15px;" data-dismiss="modal" >Aceptar</button>
                    `

                    $("#mdl-carga-servicios-title").text('Carga completada con éxito');

                }else if(respuesta.numFilas <= 0){
                    html_respuesta = `
                  
                        <div class="form-group " >
                        
                            <label class="col-form-label">Descuentos cargados</label>
                            <p class="form-control-static text-center text-primary" id="servicios_cargados_txt" style="font-size:1.9em;"  >${respuesta.numFilas}</p>
                            
                        </div>
                        <div class="form-group" >
                            <label  for="nombre_carga">Carga</label>
                            <p class="form-control-static " > El archivo de carga no posee ningun servicio nuevo. </p>
                        </div>
                        <button type="button" class="btn btn-primary" style="width:100%;margin-top:15px; " data-dismiss="modal" >CERRAR</button>`
                        
                        $("#mdl-carga-servicios-title").text('Nada nuevo por ahora..');
                }
                $('#respuesta_servicios').append(html_respuesta);
                $("#respuesta_servicios").css('display','block');
                $("#servicios_carga_loader").css('display','none');
            });
        }

      };

})

function modalCargaSetup(){
    $('#mdl-carga-servicios').modal('show');
    $("#respuesta_servicios").empty();
    $("#respuesta_servicios").css('display','none');
    $("#servicios_carga_loader").css('display','block');
    $("#mdl-carga-servicios-title").text('Esto podría tomar tiempo..');
}

