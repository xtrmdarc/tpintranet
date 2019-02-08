$(function(){


});


function indicadores_pdf(quality = 1) {
    const filename  = 'estadistica_cliente.pdf';

    html2canvas(document.querySelector('#est_cli_div'), 
                            {scale: quality}
                     ).then(canvas => {
        let pdf = new jsPDF('p', 'mm', 'a4');
        pdf.addImage(canvas.toDataURL('image/png'), 'PNG', 0, 0, 211, 298);
        pdf.save(filename);
    });
}