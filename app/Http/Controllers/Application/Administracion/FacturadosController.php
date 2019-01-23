<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FacturadosController extends Controller
{
    //

    public function index(){

        return view('contents.Application.Administracion.facturados');

    }

    public function ac_buscar_clientes(Request $request){
        
        $data = $request->all();

        $clientes = DB::table('Cliente')->where('NombreCliente','like','%'.$data['criterio'].'%')->get();
        $clientes_busqueda = [];
        foreach($clientes as $cliente)
        {   
            $nuevo_cliente = new \stdClass();
            $nuevo_cliente->value = $cliente->IdClienteSistema;
            $nuevo_cliente->label = $cliente->NombreCliente;
            $clientes_busqueda[] = $nuevo_cliente;
        }

        return json_encode($clientes_busqueda);
    }
    
    public function buscar_facturados(Request $request){
        
        $data = $request->all();
        $facturados = DB::table('v_adm_facturados');
        //dd($data);
        if(isset($data['id_cliente']))
            $facturados = $facturados->Where('IdClienteSistema',$data['id_cliente']);

        if(isset($data['start_date']))
        {    
            $fecha_inicio = date('Y-m-d',date_create_from_format('d/m/y',trim($data['start_date']))->getTimestamp());
            $facturados = $facturados->Where('FechaEmitido','>=',$fecha_inicio);
        } 
            
        if(isset($data['end_date']))
        {
            $fecha_fin = date('Y-m-d',date_create_from_format('d/m/y',trim($data['end_date']))->getTimestamp());
            $facturados = $facturados->Where(DB::raw('date(FechaEmitido)'),'<=',$fecha_fin);
        }
            
        
        return json_encode($facturados->get());

    }


    public function BuscarServiciosXComprobante(Request $request)
    {   
        $data = $request->all();
        $servicios_comprobante = DB::table('v_sis_servicios')
                                ->where('IdComprobante',$data['id_comprobante'])->get();

        return json_encode($servicios_comprobante);
                        
    }

}
