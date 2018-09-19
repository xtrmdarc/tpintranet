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
}
