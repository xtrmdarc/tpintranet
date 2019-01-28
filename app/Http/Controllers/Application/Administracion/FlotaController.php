<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FlotaController extends Controller
{
    //
    public function index(){

        $flota = DB::table('v_adm_flota')->get();
        $tipo_asoc = DB::table('TipoAsociacion')->get();
        $data = [
            'flota' => $flota,
            'tipo_asoc' =>$tipo_asoc
        ];
        return view('contents.Application.Administracion.flota')->with($data);
    }

    public function index_editar($id){
        
        $conductor = DB::table('Conductor')->where('IdConductorSistema',$id)->first();
        $tipo_conductor = DB::table('TipoConductor')->get();
        $turnos_conductor = DB::table('Turno')->where('IdTipoTurnoSistema',2)->get();
        $data= [
            'conductor' => $conductor,
            'tipo_conductor'=> $tipo_conductor,
            'turnos_conductor' => $turnos_conductor
        ];
        return view('contents.Application.Administracion.Flota.crea_edita_index')->with($data);
    }

    public function EditarConductor(Request $request)
    {
        $data = $request->all();
        
        $conductor = DB::table('Conductor')->where('IdConductorSistema',$data['id_conductor'])
        ->update([

            'NombreConductor' => $data['nombre_contumov'],
            'Nombres'=>$data['nombres'],
            'DNI' => $data['dni'],
            'ApellidoP' => $data['apellido_paterno'],
            'ApellidoM' => $data['apellido_materno'],
            'Tienda' => $data['tienda'],
            'NumCuenta'=> $data['numero_cuenta'],
            'IdTipoConductor'=>$data['slc_tipo_conductor'],
            'IdTurnoSistema' => $data['slc_turno_conductor']
        ]);
        
        return redirect('/Administracion/Flota');
    }

    public function DetallePiloto(Request $request){

        $data = $request->all();

        $detalle = DB::table('Conductor')
                    ->join('Vehiculo','Vehiculo.IdVehiculoSistema','Conductor.IdVehiculo')
                    ->join('v_adm_flota','v_adm_flota.IdConductorSistema','Conductor.IdConductorSistema')
                    ->where('Conductor.IdConductorSistema',$data['id_piloto'])->first();
        //dd($detalle);
        return json_encode($detalle);

    }
    
    public function BuscarFlota(Request $request){

        $param = $request->all();
        $flota = DB::table('v_adm_flota');

        if(isset($param['slc_tipo_asoc'])  && $param['slc_tipo_asoc'] != "")
        {
            
            $flota = $flota->where('IdTipoAsociacion',$param['slc_tipo_asoc']);
        }
        if(isset($param['ac_movil_id'])  && $param['ac_movil_id'] != "")
        {  
            $flota = $flota->where('IdVehiculoSistema',$param['ac_movil_id']);
        }
        
        $flota = $flota->get();
    
        return json_encode($flota);
    }

    
}
