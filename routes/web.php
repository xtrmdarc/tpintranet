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

include 'Application/sistema_routes.php';
include 'Application/administracion_routes.php';
    
Route::get('/Administracion', 'Application\Administracion\ControlFacturacionController@index' );


Route::get('/Produccion','Application\Produccion\ControlProduccionController@index');

Route::get('/InicioSesion','Application\Sistema\InicioSesionController@index');

Route::get('/EditorUsuario','Application\Sistema\AjusteUsuariosController@index');
Route::post('/RegistroUsuarioRequest','Application\Sistema\AjusteUsuariosController@RegistroUsuarioRequest');

Route::get('/ListaUsuarios','Application\Sistema\AjusteUsuariosController@listar_usuario');

Route::prefix('Usuarios')->group(function(){
    
    Route::get('EditarUsuario/{usuario_id}','Application\Sistema\AjusteUsuariosController@editar_usuario');

});


