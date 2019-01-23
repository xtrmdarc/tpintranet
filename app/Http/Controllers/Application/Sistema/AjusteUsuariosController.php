<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Database\Query;
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

    public function listar_usuario()
    {
        $usuarios=DB::table('UsuarioSis')->paginate(10);
        $data=[ 'usuarios'=>$usuarios];
        return view('contents.application.sistema.listausuarios')->with($data);
    }

    public function editar_usuario($usuario_id=null, $rol_id=null)
    {
        $usuario = DB::table('UsuarioSis')->where('IDUsuarioSis',$usuario_id)->first();

        $rol = DB::table('Rol')->where('IDRol', $rol_id)->first();

        $data =[
            'usuario' => $usuario,
            'id_usuario' => $usuario?$usuario->IDUsuarioSis:''
        ];
        
        return view('contents.application.sistema.editorusuarios')->with($data);
    }

    public function eliminar_usuario($usuario_id)
    {
        $usuario = DB::table('UsuarioSis')->where('IDUsuarioSis',$usuario_id)->delete();
        //$usuario->delete();
        $usuarios=DB::table('UsuarioSis')->paginate(10);
        $data=[ 'usuarios'=>$usuarios];
        return view('contents.application.sistema.listausuarios')->with($data);

    }

    public function RegistroUsuarioRequest(Request $request)
    {
        $data = $request->all();
        //dd($data);
        
        $NombreUsuario=$data['name'];
        $ApellidoUsuario=$data['lastname'];
        $CorreoUsuario=$data['email'];
        $DNIUsuario=$data['dni'];
        $IDRol=$data['rol'];
        $PasswordUsuario=$data['password'];

        if($data['id_usuario']!="")
        {
            DB::table('UsuarioSis')->where('IDUsuarioSis',$data["id_usuario"])->update
            (
                [
                    'NombreUsuario'=>$NombreUsuario,
                    'ApellidoUsuario'=>$ApellidoUsuario,
                    'CorreoUsuario'=>$CorreoUsuario,
                    'DNIUsuario'=>$DNIUsuario,
                    'IDRol'=>$IDRol,
                    'PasswordUsuario'=>$PasswordUsuario
                ]);
        }
        else
        {
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

        
        $usuarios=DB::table('UsuarioSis')->paginate(10);
        $data2=[ 'usuarios'=>$usuarios];
        return view('contents.application.sistema.listausuarios')->with($data2);
    }

   
}
