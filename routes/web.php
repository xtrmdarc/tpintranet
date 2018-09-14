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

Route::get('/EditorUsuario','Application\Sistema\AjusteUsuariosController@index');
Route::post('/RegistroUsuarioRequest','Application\Sistema\AjusteUsuariosController@RegistroUsuarioRequest');


Route::prefix('Sistema')->group(function(){
    Route::get('CargaServicios','Application\Sistema\CargaServiciosController@index');
    Route::post('CargarServiciosRequest', 'Application\Sistema\CargaServiciosController@cargarServiciosPrincipal');
    Route::post('CargaFinProceso','Application\Sistema\CargaServiciosController@GuardarCargaNombre');
});
