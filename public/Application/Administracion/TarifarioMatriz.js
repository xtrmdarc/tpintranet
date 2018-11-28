$(function(){

    
});

$('#submit-buscar-tarifa').on('click',function(event){

    var form = $('#form-buscar-tarifa');
    $('#buscar_tarifa_loader').css('display','block');
    var direccion_origen = $('#direccion_origen').val();

    $.ajax({
        data:   {
            direccion_origen :direccion_origen
        },
        url:   '/Administracion/BuscarTarifa',
        type:  'POST',
        dataType: 'json',
        dataSrc:"",
        headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        success: function(data) {
            
            $('#table_tarifario tbody').empty();
            var tarifas_rows = ``;

            data.forEach(tarifa => {
                tarifas_rows+= `<tr>
                    <td>${tarifa.origen}</td>
                    <td>${tarifa.zona_destino}</td>
                    <td>${tarifa.destino}</td>
                    <td>${tarifa.kilometro_text}</td>
                    <td>${tarifa.kilometro.toFixed(0)}</td>
                    <td>${tarifa.duracion.toFixed(0)}</td>
                    <td>${tarifa.costo.toFixed(2)}</td>
                    
                </tr>`;
            });
            $('#buscar_tarifa_loader').css('display','none');
            $('#table_tarifario').css('display','block');
            $('#table_tarifario tbody').append(tarifas_rows);
        },
        error:function(e){
            console.log(e);
        }
    });
    //$('#buscar_tarifa_loader').css('display','none');
    return false;   
});

