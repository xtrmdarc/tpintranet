<?php

    
    Route::prefix('Sistema')->group(function(){
        //Carga de servicios    
        Route::get('CargaServicios','Application\Sistema\CargaServiciosController@index');
        Route::post('CargarServiciosRequest', 'Application\Sistema\CargaServiciosController@cargarServiciosPrincipal');
        Route::post('CargaFinProceso','Application\Sistema\CargaServiciosController@GuardarCargaNombre');
    });

?>
