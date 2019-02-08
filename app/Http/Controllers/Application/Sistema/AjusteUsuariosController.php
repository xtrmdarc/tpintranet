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

    public function editar_usuario($usuario_id=null)
    {
        $usuario = DB::table('UsuarioSis')->where('IDUsuarioSis',$usuario_id)->first();

        $roles = DB::table('Rol')->get();

        $data =[
            'usuario' => $usuario,
            'id_usuario' => $usuario?$usuario->IDUsuarioSis:'',
            'roles' => $roles
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

        $fechaingreso=$data['fechaingreso'];
        $FechaDeIngreso=date('Y-m-d',date_create_from_format('d/m/Y',trim($fechaingreso))->getTimestamp());

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
                    'PasswordUsuario'=>$PasswordUsuario,
                    'FechaDeIngresoUsuario'=>$FechaDeIngreso
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
                    'PasswordUsuario'=>$PasswordUsuario,
                    'FechaDeIngresoUsuario'=>$FechaDeIngreso
                ]
            );
        }

        
        $usuarios=DB::table('UsuarioSis')->paginate(10);
        $data2=[ 'usuarios'=>$usuarios];
        return view('contents.application.sistema.listausuarios')->with($data2);
    }

   
}
