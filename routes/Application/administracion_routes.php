<?php

    
    Route::prefix('Administracion')->group(function(){
        
        //Flota
        Route::get('Flota','Application\Administracion\FlotaController@index');
        Route::post('DetallePiloto','Application\Administracion\FlotaController@DetallePiloto');
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
        

        
    });
    
    Route::post('BuscarClientesAC','Application\Administracion\FacturadosController@ac_buscar_clientes');
?>
