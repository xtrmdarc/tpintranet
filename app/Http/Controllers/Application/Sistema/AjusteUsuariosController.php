<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjusteUsuariosController extends Controller
{
    //
    public function index()
    {
        return view ('contents.application.sistema.editorusuarios');
    }

    public function RegistroUsuarioRequest(Request $request)
    {
        $data = $request->all();
dd($data);
        $NombreUsuario=$data['name'];
        $ApellidoUsuario=$data['lastname'];
        $CorreoUsuario=$data['email'];
        $DNIUsuario=$data['dni'];
        $IDRol=$data['rol'];
        $PasswordUsuario=$data['password'];

        DB::table('UsuarioSis')->insert
        (
            [
                'NombreUsuario'=>$NombreUsuario,
                'ApellidoUsuario'=>$ApellidoUsuario,
                'CorreoUsuario'=>$CorreoUsuario,
                'DNIUsuario'=>$DNIUsuario,
                'IDRol'=>$IDRol,
                'PasswordUsuario'=>$PasswordUsuario
            ]
        );
        
    }
}
