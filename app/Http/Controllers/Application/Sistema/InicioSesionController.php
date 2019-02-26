<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Database\Query;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class InicioSesionController extends Controller
{
    public function index()
    {
        return view('iniciosesion');
    }
    
    //obtiene el usuario para el login        
    public function Login(Request $request)
    {
        //Obtenemos los datos que nos pasa la vista
        $data = $request->all();
        //creamos variables
        $usuario = $data['user'];
        $password = $data['pass'];
        //variable existe
        $existe = DB::table('UsuarioSis')->where('User',$usuario)->where('PasswordUsuario',$password)->exists(); // true or false;
        
        if($existe)
        {
            // session(['usuario'=>DB::table('UsuarioSis')->where('usuario',$usuario)->where('password',$password)->first()]);
            return redirect('/Produccion');
        }
        else
        {
            $datos = 
            ['mensaje' => 'No se encontró la combinación de usuario y contraseña'];
            return view('iniciosesion')->with($datos);
        }
        
        return ;
    }

}
