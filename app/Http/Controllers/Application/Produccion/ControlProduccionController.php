<?php

namespace App\Http\Controllers\Application\Produccion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ControlProduccionController extends Controller
{
    //
    public function index()
    {   

        // Obtener la produccion promedio por turno de conductor
        $db_prod_prom_semana_tc = DB::select('call sp_prod_prom_semana_turno_cond');


        // Obtener la puntualidad por turno de operador
        $db_puntualidad_semana_to = DB::select('call sp_puntualidad_semana_turno_ope');



        // Obtener los servicios por semana por turno de operador
        $db_serv_semana_to = DB::select('call sp_serv_semana_turno_ope');        
        $numero_turnos_to = sizeof(DB::table('Turno')->where('IdTipoTurnoSistema',1)->get());
        $objetivos_serv_semana_to = DB::table('Objetivos')->where('IdMedicion',2)->get();
        // dd(array_column($db_prod_prom_semana_tc,'DescTurno'));
        // dd(array_count_values(array_column($db_prod_prom_semana_tc,'DescTurno')));
        $data =[
            //añadir data para serv semana por turno de operador
            'serv_semana_to' => $db_serv_semana_to,
            'numero_turnos_to' => $numero_turnos_to,
            'objetivos_serv_semana_to' => $objetivos_serv_semana_to,
            //añadir data para produccion promedio turno de conductor
            'prod_prom_semana_tc' =>$db_prod_prom_semana_tc,
            //añadir data para puntualidad por turno de operador
            'puntuaidad_semana_to' => $db_puntualidad_semana_to
            
        ];
        return view('contents.Application.Produccion.indicadores')->with($data);

    }




}