<?php

namespace App\Http\Controllers\Application\Gerencia;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EstadisticaClientesController extends Controller
{
    //
    public function index()
    {
        $crecimiento_semana_db = DB::select('call sp_crecimiento_semanas');
        $estadistica_clientes_db = DB::select('call sp_estadistica_clientes');
        $data = [
            'est_cli' => $estadistica_clientes_db,
            'crec_semanal' =>$crecimiento_semana_db
        ];
        //dd(count(array_count_values(array_column($estadistica_clientes_db,'semana'))));
    
        return view('contents.Application.gerencia.estadistica_clientes')->with($data);
    }
}
