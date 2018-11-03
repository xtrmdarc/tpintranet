<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ServiciosController extends Controller
{
    //
    public function index(){

        $servicios = DB::table('v_sis_servicios')->paginate(15);
        $data= [
            'servicios' => $servicios
        ];
        return view('contents.Application.Sistema.servicios')->with($data);
    }

    public function setEmpresaServicio(Request $request){
        
        $data = $request->all();
        DB::table('Servicio')->where('IdServicioSistema',$data['IdServicio'])->update(['IdEmpresa'=>$data['IdEmpresa']]);
        return json_encode(1);
    }
    public function ac_buscar_moviles(Request $request)
    {
        $data = $request->all();
        
        $Vehiculos = DB::table('Vehiculo')->where('IdVehiculo','like','%'.$data['criterio'].'%')->get();
        $Vehiculos_busqueda = [];
        foreach($Vehiculos as $vehiculo)
        {   
            $nuevo_vehiculo = new \stdClass();
            $nuevo_vehiculo->value = $vehiculo->IdVehiculoSistema;
            $nuevo_vehiculo->label = $vehiculo->IdVehiculo;
            $Vehiculos_busqueda[] = $nuevo_vehiculo;
        }

        return json_encode($Vehiculos_busqueda);
    }

    public function buscarServicios(Request $request)
    {   
        $params = $request->all();
       
        
        //dd($params);
        $servicios = DB::table('v_sis_servicios');
        if(isset($params['ac_movil_id']))
        {
            $servicios= $servicios->where('IdVehiculo',$params['ac_movil']);
        }
        if(isset($params['daterangepicker']))
        {
            $fecha_inicio_pre = substr($params['daterangepicker'],'0',strpos($params['daterangepicker'],'-')-1);
            //dd(date_create_from_format('d/m/Y',$fecha_inicio_pre));
            $fecha_inicio = date('Y-m-d',date_create_from_format('d/m/Y',trim($fecha_inicio_pre))->getTimestamp());

            $fecha_fin_pre =substr($params['daterangepicker'],strpos($params['daterangepicker'],'-')+2);
            $fecha_fin = date('Y-m-d',date_create_from_format('d/m/Y',trim($fecha_fin_pre))->getTimestamp());

            $servicios= $servicios->Where('FechaServicio','>=',$fecha_inicio);
            $servicios= $servicios->Where('FechaServicio','<=',$fecha_fin);
        }
        if(isset($params['ac_cliente_id']))
        {
            $servicios= $servicios->Where('IdClienteSistema',$params['ac_cliente_id']);
        }

        $servicios  =$servicios->get();

        $data= [
            'servicios' => $servicios
        ];
        return view('contents.Application.Sistema.servicios')->with($data);
    }
}
