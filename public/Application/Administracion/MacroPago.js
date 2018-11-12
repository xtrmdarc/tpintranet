$(function(){

});
/*
$('.frm-macro-pago').on('submit',function(e){
    var start_date = $('#periodo_facturados').data('daterangepicker').startDate.format('DD/MM/YY'),
    end_date = $('#periodo_facturados').data('daterangepicker').endDate.format('DD/MM/YY');
    e.preventDefault();
    e.stopImmediatePropagation();
    var form = $(e.target);
    console.log(($(this).find(':input')));
    $.ajax({
        data: {
              
        },
        url:   form.attr('action'),
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

        

});*/