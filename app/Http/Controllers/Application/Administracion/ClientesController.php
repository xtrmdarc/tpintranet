<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ClientesController extends Controller
{
    //
    public function index(){

        $clientes = DB::table('Cliente')->get();
        $tipo_asoc = DB::table('TipoAsociacion')->get();
        
        $data = [
            'clientes' => $clientes,
            'tipo_asoc' =>$tipo_asoc
        ];
        return view('contents.Application.Administracion.clientes')->with($data);
    }

    public function index_editar($id){
        
        $cliente = DB::table('Cliente')->where('IdClienteSistema',$id)->first();
        $empresas = DB::table('Empresa')->get();
        $data= [
            'cliente'=>$cliente,
            'empresas'=>$empresas
        ];
        return view('contents.Application.Administracion.Clientes.crea_edita_cliente')->with($data);
    }

    public function index_crear(){
        
        $cliente = new \stdClass();
        $cliente->NombreCliente = '';
        $cliente->IdClienteSistema = '';
        $cliente->IdCliente = '';
        $cliente->RUC = '';
        $cliente->IdEmpresa = '';
        $empresas = DB::table('Empresa')->get();
        $data= [
            'cliente'=>$cliente,
            'empresas'=>$empresas
        ];
        
        return view('contents.Application.Administracion.Clientes.crea_edita_cliente')->with($data);
    }


    public function GuardarCliente(Request $request){

        $data = $request->all();
        if($data['id_cliente']!=''){
            DB::table('Cliente')->where('IdClienteSistema',$data['id_cliente'])
                            ->update([
                                'NombreCliente'=> $data['nombre_contumov'],
                                'IdCliente'=>$data['id_contumov'],
                                'IdEmpresa'=>$data['slc_tipo_conductor'],
                                'RUC'=>$data['ruc']
                            ]);
        }
        else{
            DB::table('Cliente')->insert([
                'NombreCliente'=> $data['nombre_contumov'],
                'IdCliente'=>$data['id_contumov'],
                'IdEmpresa'=>$data['slc_tipo_conductor'],
                'RUC'=>$data['ruc']
            ]);
        }
        
        return redirect('/Administracion/Clientes');

    }
}
