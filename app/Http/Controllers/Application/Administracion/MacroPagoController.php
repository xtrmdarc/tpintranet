<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Excel\ExportFromArray;


class MacroPagoController extends Controller
{
    //
    public function index()
    {
        return view('contents.Application.Administracion.macro_pago');
    }

    public function ObtenerMacrosPago(Request $request){

        $data = $request->all();
        //dd($data);
        $fecha_inicio_pre = substr($data['daterangepicker'],'0',strpos($data['daterangepicker'],'-')-1);
        $fecha_inicio = date('Y-m-d',date_create_from_format('d/m/Y',trim($fecha_inicio_pre))->getTimestamp());

        $fecha_fin_pre =substr($data['daterangepicker'],strpos($data['daterangepicker'],'-')+2);
        $fecha_fin = date('Y-m-d',date_create_from_format('d/m/Y',trim($fecha_fin_pre))->getTimestamp());

        $macro_pago = DB::select('call macro_pago (?,?,?)', [$fecha_inicio,$fecha_fin,$data['id_empresa']]);
        
        return Excel::download(new ExportFromArray($macro_pago),'MP_'.($data['id_empresa']=='1'?'taxi':'puntual').'_'.$fecha_inicio.'_al_'.$fecha_fin.'.xlsx');
    }

}
