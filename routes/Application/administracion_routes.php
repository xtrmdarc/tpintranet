<?php

    
    Route::prefix('Administracion')->group(function(){
        
        //Flota
        Route::get('Flota','Application\Administracion\FlotaController@index');
        

    });

?>
