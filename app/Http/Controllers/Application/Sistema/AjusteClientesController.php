<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Database\Query;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjusteClientesController extends Controller
{
    public function index()
    {
        
       return view ('contents.application.sistema.editorcliente');
    }

    public function listar_cliente()
    {
        $clientes=DB::table('Cliente')->paginate(10);
        $data=[ 'clientes'=>$clientes];
        return view('contents.application.sistema.listaclientes')->with($data);
    }

    public function RegistroClienteRequest(Request $request)
    {
        $data = $request->all();
        //dd($data);
        
        $IdCliente=$data['idcliente'];
        $NombreCliente=$data['nombrecliente'];
        $IdEmpresa=$data['idempresa'];
        $RUC=$data['ruc'];

        if($data['id_usuario']!="")
        {
            DB::table('Cliente')->where('IdClienteSistema',$data["IdClienteSistema"])->update
            (
                [
                    'IdCliente'=>$IdCliente,
                    'NombreCliente'=>$NombreCliente,
                    'IdEmpresa'=>$IdEmpresa,
                    'RUC'=>$RUC
                ]);
        }
        else
        {
            DB::table('Cliente')->insert
            (
                [
                    'IdCliente'=>$IdCliente,
                    'NombreCliente'=>$NombreCliente,
                    'IdEmpresa'=>$IdEmpresa,
                    'RUC'=>$RUC
                ]
            );
        }

        $clientes=DB::table('Cliente')->paginate(10);
        $data2=[ 'clientes'=>$clientes];
        return view('contents.application.sistema.listaclientes')->with($data2);
    }

    public function editar_cliente($clientesis_id=null)
    {
        $usuario = DB::table('Cliente')->where('IdClienteSistema',$clientesis_id)->first();

        $data =[
            'cliente' => $cliente,
            'id_cliente' => $cliente?$cliente->IdClienteSistema:''
        ];
        
        return view('contents.application.sistema.editorclientes')->with($data);
    }
}