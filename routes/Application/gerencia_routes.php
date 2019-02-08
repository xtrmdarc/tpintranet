<?php

    Route::prefix('Gerencia')->group(function(){
        Route::get('EstCli','Application\Gerencia\EstadisticaClientesController@index');
    });

?>