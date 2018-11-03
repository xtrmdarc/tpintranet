<?php

    
    Route::prefix('Sistema')->group(function(){
        //Carga de Descuentos
        Route::get('CargaDescuentos','Application\Sistema\CargaServiciosController@InicioCargaDescuento');
        Route::post('CargarDescuentosRequest','Application\Sistema\CargaServiciosController@CargarDescuentos');

        //Carga de servicios    
        Route::get('CargaServicios','Application\Sistema\CargaServiciosController@index');
        Route::post('CargarServiciosRequest', 'Application\Sistema\CargaServiciosController@cargarServiciosPrincipal');
        Route::post('CargaFinProceso','Application\Sistema\CargaServiciosController@GuardarCargaNombre');

        //Servicios
        Route::get('Servicios','Application\Sistema\ServiciosController@index');
        Route::post('AsignarEmpresaServicio','Application\Sistema\ServiciosController@setEmpresaServicio');
        Route::post('BuscarServicios','Application\Sistema\ServiciosController@buscarServicios');
    });

?>
