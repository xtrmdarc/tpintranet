<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FlotaController extends Controller
{
    //
    public function index(){

        $flota = DB::table('v_adm_flota')->paginate(10);

        $data = [
            'flota' => $flota
        ];
        return view('contents.Application.Administracion.flota')->with($data);
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
    

}
