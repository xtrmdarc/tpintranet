<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Excel\ExportFromArray;

class TarifarioMatrixController extends Controller
{
    //

    public function index(){
        return view('contents.Application.Administracion.tarifario_matriz');
    }

    public function BuscarTarifa(Request $request)
    {   

        $data = $request->all();
        $direccion = $data['direccion_origen'];
        $zonas = DB::table('Zona')->get();
        $tarifario =[];
        $cont = 0;
   
        foreach($zonas as $zona){
            
                $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
                $context = stream_context_create($opts);
                $url = "https://maps.googleapis.com/maps/api/directions/json?origin=".urlencode(trim($direccion))."&destination=".urlencode(trim($zona->PuntoReferencia))."&alternatives=true&key=AIzaSyDYqLIC2Li4fVBTAW-WTovhWpyaZ3BuyVQ";
                $data = json_decode(@file_get_contents($url,false,$context));
                //dd($url,$data);
                $tarifa = new \stdClass();
                $tarifa->origen = trim($direccion);
                $tarifa->zona_destino = $zona->IdZona;
                $tarifa->destino = $zona->PuntoReferencia;
                
                if(!isset($data->routes[0]->legs)) 
                {
                    $tarifa->costo =0;
                    dd($data);
                }
                else{
                   
                    
                    $tarifa->kilometro = $this->GetPromedioRutasDistancia($data->routes);
                    $tarifa->kilometro_text = round($tarifa->kilometro/1000,2)." km";
                    $tarifa->duracion = $this->GetPromedioRutasTiempo($data->routes);
                    $tarifa->costo = round($tarifa->kilometro/1000< 20? $tarifa->kilometro/1000*1.5 + 10:$tarifa->kilometro/1000*2 ,2);
                    //dd($data);
                   
                }
                
                
                $tarifario[] = $tarifa;
               
            
        }
        //$tarifario->toArray();
        session(['tarifario'=>$tarifario]);
        return $tarifario;
    }

    public function ExportarTarifarioExcel()
    {
        //dd(session('tarifario'));
        //$tarifario = [];
        ob_end_clean();
        ob_start();
        
        return Excel::download(new ExportFromArray(session('tarifario')),'tarifario-21-10-2018.xlsx');

    }

    public function GetPromedioRutasDistancia($rutas)
    {   
        $suma = 0;
        $cont = 0;
        foreach ($rutas as $ruta) {
            $suma += $ruta->legs[0]->distance->value;
            $cont++;
        }
        if($cont== 0) 
        $promedio = $suma/$cont;
        return $promedio;
    }

    public function GetPromedioRutasTiempo($rutas)
    {   
        $suma = 0;
        $cont = 0;
        foreach ($rutas as $ruta) {
            $suma += $ruta->legs[0]->duration->value;
            $cont++;
        }
        $promedio = $suma/$cont;
        return $promedio;
    }

}
