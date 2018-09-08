<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    
Route::get('/Administracion', 'Application\Administracion\ControlFacturacionController@index' );

Route::get('/Produccion','Application\Produccion\ControlProduccionController@index');

Route::get('/InicioSesion','Application\Sistema\InicioSesionController@index');

<<<<<<< HEAD
Route::get('/EditorUsuario','Application\Sistema\AjusteUsuariosController@index');
=======
Route::get('/RegistroUsuario','Application\Sistema\RegistroUsuarioController@index');

Route::prefix('Sistema')->group(function(){
    Route::get('CargaServicios','Application\Sistema\CargaServiciosController@index');
    Route::post('CargarServiciosRequest', 'Application\Sistema\CargaServiciosController@cargarServiciosPrincipal');
});
>>>>>>> 2562309cb8720590d27938351be7636f9b995370
