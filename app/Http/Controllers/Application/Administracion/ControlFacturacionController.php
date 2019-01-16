<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Excel\ExportFromArray;

class ControlFacturacionController extends Controller
{
    //
    public function index()
    {

        $clientes_facturar_cred = DB::table('Cliente')
                                    ->select('Cliente.IdClienteSistema', 'Cliente.NombreCliente','Servicio.IdServicioSistema','Servicio.NumVale','Usuario.NombreUsuario', 'Servicio.MontTotalCredito','Servicio.FechaServicio')
                                    ->join('Servicio','Servicio.IdCliente','Cliente.IdClienteSistema')
                                    ->join('Usuario','Usuario.IdUsuarioSistema','Servicio.IdUsuarioTransportado')
                                    ->Where('Servicio.EsCredito',1)
                                    ->Where('Servicio.ServicioProcesado',0)
                                    ->get()
                                    ->groupBy('IdClienteSistema','NombreCliente')->toArray();

        //$clientes_facturar_cred = DB::select('SELECT DISTINCT c.IdCliente FROM Cliente c LEFT JOIN Servicio s ON c.IdCliente = s.IdCliente');

        $clientes_cred = [];
        //dd($clientes_facturar_cred)  ;
        foreach($clientes_facturar_cred as $k=>$servicios){
            $cliente_facturar = new \stdClass();
            $cliente_facturar->NombreCliente = reset($servicios)->NombreCliente;
            
            $cliente_facturar->IdCliente = reset($servicios)->IdClienteSistema;
            
            $servicios_cliente = [];
            foreach($servicios as $servicio){
                $servicios_cliente[] = $servicio;
            }
            $cliente_facturar->servicios = $servicios_cliente;
            $clientes_cred[] = $cliente_facturar;
        }
        //dd($clientes_cred);

        $tipo_comprobantes = DB::table('TipoComprobante')->get();
        $clientes = DB::table('Cliente')->select('NombreCliente','IdClienteSistema')->get();
        $igv = DB::table('VariablesEntorno')->first()->Igv;
        
        $data = [
            'clientes_cred' => $clientes_cred,
            'tipo_comprobantes' => $tipo_comprobantes,
            'clientes'=> $clientes,
            'igv' => (float)$igv
        ];
        
        return view('contents.Application.Administracion.control_facturacion')->with($data);
    }

    public function procesarComprobante(Request $request){
        $data = $request->all();

        //dd($data);
        date_default_timezone_set('America/Lima');
        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
        $fecha_emitido = date("Y-m-d H:i:s");
        $indentificador_cp = trim($data['Identificador']);
        $comprobante = DB::table('Comprobante')->where('Identificador', $indentificador_cp);
        if(!($comprobante->exists()))
        {
            $insert_comprobante = [
                'MontSubTotal'=>$data['MontSubTotal'],
                'MontIgv' => $data['MontIgv'],
                'MontTotal' => $data['MontTotal'],
                'IdCliente' => $data['IdCliente'],
                'FechaEmitido' => $fecha_emitido,
                'IdUsuarioFactura' => null,
                'IdTipoComprobante' => $data['IdTipoComprobante'],
                'Identificador' => $indentificador_cp
            ];
            $comprobante_id = DB::table('Comprobante')->insertGetId($insert_comprobante);
        }
        else
        {   
            $comprobante_obj =$comprobante->first(); 
            $comprobante_id = $comprobante_obj->IdComprobante;
            $update_comprobante = [
                'MontSubTotal'=>$data['MontSubTotal']+$comprobante_obj->MontSubTotal,
                'MontIgv' => $data['MontIgv']+$comprobante_obj->MontIgv,
                'MontTotal' => $data['MontTotal']+$comprobante_obj->MontTotal
            ];
            DB::table('Comprobante')->where('IdComprobante',$comprobante_id)->update($update_comprobante);
        }
        
        $servicios_id = array();
        foreach($data['servicios'] as $servicio ){
            $servicios_id[] = $servicio['IdServicioSistema'];
        }
        
        DB::table('Servicio')->whereIn('IdServicioSistema',$servicios_id)->update(['ServicioProcesado'=>1,'IdComprobante'=>$comprobante_id,'NumComprobante'=>$indentificador_cp]);

        return json_encode(1);
    }

    public function ExportarComprobanteExcel(Request $request)
    {
        $data = $request->all();
        $servicios_comprobante = DB::table('v_sis_servicios')
                                ->where('IdComprobante',$data['id_comprobante'])->get();

        $comprobante_actual = DB::table('Comprobante',$data['id_comprobante'])->first();

        return Excel::download(new ExportFromArray($servicios_comprobante),'Comprobante_'.$comprobante_actual->Identificador.'.xlsx');

    }
    
}
