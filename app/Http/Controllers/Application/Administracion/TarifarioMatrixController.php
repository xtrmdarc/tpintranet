<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class TarifarioMatrixController extends Controller
{
    //
    public $tarifario;

    public function index(){
        return view('contents.Application.Administracion.tarifario_matriz');
    }

    public function BuscarTarifa(Request $request)
    {   

        $data = $request->all();
        $direccion = $data['direccion_origen'];
        $zonas = DB::table('Zona')->get();
       
        foreach($zonas as $zona){
            $opts = array('http'=>array('header' => "User-Agent:MyAgent/1.0\r\n"));
            $context = stream_context_create($opts);
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode(trim($direccion))."&destinations=".urlencode(trim($zona->PuntoReferencia))."&key=AIzaSyDYqLIC2Li4fVBTAW-WTovhWpyaZ3BuyVQ";
            $data = json_decode(file_get_contents($url,false,$context));
            
            $tarifa = new \stdClass();
            $tarifa->origen = trim($direccion);
            $tarifa->zona_destino = $zona->IdZona;
            $tarifa->destino = $zona->PuntoReferencia;
            
            if(!isset($data->rows[0]->elements[0]->distance)) 
            {
                $tarifa->costo =0;
            }
            else{
                $tarifa->kilometro_text = $data->rows[0]->elements[0]->distance->text;
                $tarifa->kilometro = $data->rows[0]->elements[0]->distance->value;
                $tarifa->duracion = $data->rows[0]->elements[0]->duration->text;
                $tarifa->costo = round($data->rows[0]->elements[0]->distance->value/1000*1.3 + 3,2);
            }
            
            
            $tarifario[] = $tarifa;
        }

        return $tarifario;
    }

    public function ExportarTarifarioExcel()
    {
        //dd($tarifario);
        //$tarifario = [];
        Excel::download(new ExportFromArray($tarifario),'tarifario-21/10/2018.xlsx');

    }
}
