<?php

    
    Route::prefix('Administracion')->group(function(){
        
        //Flota
        Route::get('Flota','Application\Administracion\FlotaController@index');
        

        Route::get('TarifarioMatriz','Application\Administracion\TarifarioMatrixController@index');
        Route::post('BuscarTarifa','Application\Administracion\TarifarioMatrixController@BuscarTarifa');
    });

?>
