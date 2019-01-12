<?php

    
    Route::prefix('Sistema')->group(function(){
        //Carga de servicios    
        Route::get('CargaServicios','Application\Sistema\CargaServiciosController@index');
        Route::post('CargarServiciosRequest', 'Application\Sistema\CargaServiciosController@cargaZonasPrincipal');
        Route::post('CargaFinProceso','Application\Sistema\CargaServiciosController@GuardarCargaNombre');

        //Servicios
        Route::get('Servicios','Application\Sistema\ServiciosController@index');
        Route::post('AsignarEmpresaServicio','Application\Sistema\ServiciosController@setEmpresaServicio');
    });

    

?>
