<?php

    
    Route::prefix('Administracion')->group(function(){
        
        //Flota
        Route::get('Flota','Application\Administracion\FlotaController@index');
        Route::post('DetallePiloto','Application\Administracion\FlotaController@DetallePiloto');
        Route::post('BuscarFlota','Application\Administracion\FlotaController@BuscarFlota');
        Route::prefix('Flota')->group(function(){
            Route::get('/{id}','Application\Administracion\FlotaController@index_editar');
            Route::post('/EditarConductor','Application\Administracion\FlotaController@EditarConductor');
        });

        //Control Facturacion
        Route::get('CFacturacion','Application\Administracion\ControlFacturacionController@index');
        Route::post('ProcesarComprobante','Application\Administracion\ControlFacturacionController@procesarComprobante');
        
        //Tarifario
        Route::get('TarifarioMatriz','Application\Administracion\TarifarioMatrixController@index');
        Route::post('BuscarTarifa','Application\Administracion\TarifarioMatrixController@BuscarTarifa');
        Route::get('ExportarTarifarioExcel','Application\Administracion\TarifarioMatrixController@ExportarTarifarioExcel');
        
        //Facturados
        Route::get('Facturados','Application\Administracion\FacturadosController@index');
        Route::post('BuscarFacturados','Application\Administracion\FacturadosController@buscar_facturados');
        
        //MacroPago
        Route::get('MacroPago','Application\Administracion\MacroPagoController@index');
        Route::post('ObtenerMacrosPago','Application\Administracion\MacroPagoController@ObtenerMacrosPago');
        
    });
    
    Route::post('BuscarClientesAC','Application\Administracion\FacturadosController@ac_buscar_clientes');
    Route::post('BuscarMovilAC','Application\Sistema\ServiciosController@ac_buscar_moviles');
?>
