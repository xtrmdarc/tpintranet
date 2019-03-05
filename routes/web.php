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
include 'Application/produccion_routes.php';
include 'Application/gerencia_routes.php';
include 'Landing/landing_routes.php';
Route::get('/Administracion', 'Application\Administracion\ControlFacturacionController@index' );

Route::get('/Produccion','Application\Produccion\ControlProduccionController@index');

//Login
Route::get('/InicioSesion','Application\Sistema\InicioSesionController@index');
Route::post('/Login','Application\Sistema\InicioSesionController@Login');

//Usuario
Route::get('/EditorUsuario','Application\Sistema\AjusteUsuariosController@editar_usuario');

Route::post('/RegistroUsuarioRequest','Application\Sistema\AjusteUsuariosController@RegistroUsuarioRequest');

Route::get('/ListaUsuarios','Application\Sistema\AjusteUsuariosController@listar_usuario');

Route::prefix('Usuarios')->group(function()
{   
    
    Route::get('EditarUsuario/{usuario_id}','Application\Sistema\AjusteUsuariosController@editar_usuario');
    Route::get('EliminarUsuario/{usuario_id}','Application\Sistema\AjusteUsuariosController@eliminar_usuario');

}
);

//Turno
Route::get('/EditorTurno','Application\Sistema\AjusteTurnoController@editar_turnos');

Route::post('/RegistroTurnoRequest','Application\Sistema\AjusteTurnoController@RegistroTurnoRequest');

Route::get('/ListaTurnos','Application\Sistema\AjusteTurnoController@listar_turnos');

Route::prefix('Turnos')->group(function()
{
    
    Route::get('EditarTurno/{idturno}','Application\Sistema\AjusteTurnoController@editar_turnos');
    Route::get('EliminarTurno/{idturno}','Application\Sistema\AjusteTurnoController@eliminar_turnos');

}
);





