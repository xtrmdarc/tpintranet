<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class CargaServiciosController extends Controller
{
    //
    public function index(){
        return view('contents.Application.Sistema.carga_servicios');
    }
    
    public function cargarServiciosPrincipal(Request $request){
        
        $servicios_file = fopen($request->file,'r');
        //dd($servicios_xls);
        $cont_fila = 0;
        while (($emapData = fgetcsv($servicios_file, 10000, ",")) !== FALSE){
            
            $cont_fila++;

            if($cont_fila > 1)
            {
                $q = DB::select('select * from usuario where active = ?', [1]);
                dd($q);
            }
            
            

        }
    }

}