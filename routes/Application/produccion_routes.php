<?php

    Route::prefix('Produccion')->group(function(){
        Route::get('/','Application\Produccion\ControlProduccionController@index');
        
    });
    
?>