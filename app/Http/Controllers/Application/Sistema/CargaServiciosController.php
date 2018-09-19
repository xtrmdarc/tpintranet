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
        $response = new \stdClass();
        try{
            
            $servicios_file = fopen($request->file,'r');
            //dd($servicios_xls);
            $cont_fila = 0;
            $id_carga = 0;
            $cont = 0;
            


            while (($emapData = fgetcsv($servicios_file, 10000, ",")) !== FALSE){
                
                $cont_fila++;

                if($cont_fila > 1)
                {   

                    //Verificar si el servicio existe en nuestra bd
                    $id_servicio = $emapData[0];

                    if(!DB::table('Servicio')->where('IdServicio',$id_servicio)->exists()){
                        
                        date_default_timezone_set('America/Lima');
                        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
                        $fecha_carga = date("Y-m-d H:i:s");
                        
                        $esContado = false;


                        //Variables de tabla servicio
                        $fechaServicio = date('Y-m-d', strtotime(trim($emapData[2])));
                        $horaProgramada = date('H:i:s',strtotime(trim($emapData[3])));

                        $montContado = $emapData[14];
                        $montTotalCred = $emapData[15];
                        $montAdela = $emapData[16];
                        $numVale = $emapData[17];
                        $MontTransporteCred = $emapData[33];
                        $MontEstaciona = $emapData[34];
                        $MontAireAcond= $emapData[35];
                        $MontPeaje= $emapData[36];
                        $MontEspera= $emapData[37];
                        //basado en minutos
                        $TiempoEspera= $emapData[38];
                        //Cast to correct datetime format
                        $FechaRegistroServicio= date('Y-m-d H:i:s',strtotime(trim($emapData[39])));
                        //---
                        $HoraLlegadaVehiculo= date('H:i:s',strtotime(trim($emapData[40])));
                        $HoraInicioServicio= date('H:i:s',strtotime(trim($emapData[41])));
                        $HoraFinServicio= date('H:i:s',strtotime(trim($emapData[42])));
                        $dirOrigen  =  $emapData[43];
                        $dirFin = $emapData[44];

                        $id_cliente = 0;
                        $id_usuario = 0;
                        $id_conductor = 0;
                        $id_vehiculo = 0;
                        $id_moneda = 0;
                        $id_tipo_auto = 0;
                        $id_tipo_servicio = 0;
                        $id_empresa = 0;
                        $id_esContado = 0;
                        $id_esCredito = 0;
                        //--------------
                        //handle Cliente
                        $id_cliente_xls = $emapData[4];
                        $nombre_cliente_xls = trim($emapData[5]);

                        $cliente = DB::table('Cliente')->where('IdCliente',$id_cliente_xls);
                        if($cliente->exists())
                        {  
                        
                            $cliente_obj = $cliente->first();
                            $id_cliente = $cliente_obj->IdClienteSistema;
                        }
                        else{
                            $id_cliente = DB::table('Cliente')->insertGetId(['IdCliente'=> $id_cliente_xls, 'NombreCliente'=> $nombre_cliente_xls ]);
                        }

                        //handle Usuario
                        $id_usuario_xls = $emapData[53];
                        $nombre_usuario_xls = trim($emapData[7]);
                        $usuario = DB::table('Usuario')->where('IdUsuario',$id_usuario_xls);
                        if($usuario->exists()){
                            $usuario_obj = $usuario->first();
                            $id_usuario  = $usuario_obj->IdUsuarioSistema;
                        }
                        else{
                            $id_usuario = DB::table('Usuario')->insertGetId(['IdUsuario' => $id_usuario_xls, 'NombreUsuario' => $nombre_usuario_xls]);
                        }
                        //handle tipo servicio
                        $desc_tipo_servicio_xls = trim($emapData[19]);
                        $tipo_servicio = DB::table('TipoServicio')->where('DescTipoServicio',$desc_tipo_servicio_xls);
                        if($tipo_servicio->exists()){
                            $tipo_servicio_obj = $tipo_servicio->first();
                            $id_tipo_servicio  = $tipo_servicio_obj->IdTipoServicioSistema;
                        }
                        else{
                            $id_tipo_servicio = DB::table('TipoServicio')->insertGetId(['DescTipoServicio' => $desc_tipo_servicio_xls]);
                        }
                        //handle tipo auto
                        $desc_tipo_auto_xls = trim($emapData[20]);
                        $tipo_auto = DB::table('TipoAuto')->where('DescTipoAuto',$desc_tipo_auto_xls);
                        if($tipo_auto->exists()){
                            $tipo_auto_obj = $tipo_auto->first();
                            $id_tipo_auto  = $tipo_auto_obj->IdTipoAutoSistema;
                        }
                        else{
                            $id_tipo_auto = DB::table('TipoAuto')->insertGetId(['DescTipoAuto' => $desc_tipo_auto_xls]);
                        }
                        
                        //handle piloto vehiculo
                        $id_vehiculo_xls = trim($emapData[10]);
                        $id_conductor_xls = trim($emapData[54]);
                        $nombre_conductor_xls = trim($emapData[55]);
                        $cod_planilla_conductor_xls = trim($emapData[18]);
                        //vehiculo
                        $vehiculo = DB::table('Vehiculo') ->where('IdVehiculo',$id_vehiculo_xls);
                        if($vehiculo->exists()){
                            $vehiculo_obj = $vehiculo->first();
                            $id_vehiculo = $vehiculo_obj->IdVehiculoSistema;
                        }
                        else{
                            
                            $id_vehiculo = DB::table('Vehiculo')->insertGetId(['IdVehiculo'=> $id_vehiculo_xls]);
                        }


                        //conductor
                        $conductor = DB::table('Conductor')->where('IdConductor',$id_conductor_xls);
                        if($conductor->exists()){
                            $conductor_obj = $conductor->first();
                            $id_conductor = $conductor_obj->IdConductorSistema;
                        }
                        else{
                            
                            if(substr($id_vehiculo_xls,1,1) == 'M' ){
                                $id_tipo_asociacion = 1; //Permanente
                            }
                            else{
                                $id_tipo_asociacion = 2; //Apoyo
                            }

                            $id_conductor = DB::table('Conductor')->insertGetId(['IdConductor'=> $id_conductor_xls,
                                                                                'NombreConductor'=> $nombre_conductor_xls,
                                                                                'IdVehiculo' => $id_vehiculo,
                                                                                'CodPlanillaConductor' => $cod_planilla_conductor_xls,
                                                                                'IdTipoAsociacion'=>$id_tipo_asociacion]);

                        }

                        //Representacion
                        $moneda_xls = trim($emapData[13]);

                        $representacion = DB::table('Moneda')->where('SimbMoneda',$moneda_xls);
                        if($representacion->exists()){
                            $representacion_obj = $representacion->first();
                            $id_moneda = $representacion_obj->IdMonedaSistema;
                        }
                        else {
                            $id_moneda = DB::table('Moneda')->insertGetId(['SimbMoneda'=> $moneda_xls]);
                        }

                        //handle credito o contado
                        if((int)$montContado > 0)$esContado = true;

                        if($esContado){
                            
                            //A quien le pertenece el servicio
                            //si es contado, por defecto son de taxi puntual (a menos que un cliente de puntual pida factura por el servicio o el servicio lo haga la M020)
                            
                            //handle id Empresa
                            $id_empresa = 1; //TaxiPuntual
                            $id_esContado = 0;

                        }
                        else{

                            $id_esCredito = 0;
                            //handle id empresa
                            $cliente_obj_v = DB::table('Cliente')->where('IdClienteSistema',$id_cliente)->first();
                            if($cliente_obj_v->IdEmpresa != null  || $cliente_obj_v->IdEmpresa != '' || isset($cliente_obj_v->IdEmpresa) || $cliente_obj_v->IdEmpresa != 0 ){
                                $id_empresa = $cliente_obj_v->IdEmpresa;
                            }
                            else{
                                $id_empresa = null;
                            }
                            //---
                        }   

                        if($id_carga == 0)
                        $id_carga = DB::table('Carga')->insertGetId(['FechaCarga'=>$fecha_carga]);

                        $servicios_val_arr = [
                            'IdServicio' => $id_servicio,
                            'FechaServicio' => $fechaServicio,
                            'HoraProgramada' => $horaProgramada,
                            'MontContado' => $montContado,
                            'MontTotalCredito' => $montTotalCred,
                            'MontAdela' => $montAdela,
                            'NumVale' => $numVale,
                            'MontEstaciona' => $MontEstaciona,
                            'MontAireAcond' => $MontAireAcond,
                            'MontPeaje'=> $MontPeaje,
                            'MontEspera' => $MontEspera,
                            'TiempoEspera' => $TiempoEspera,
                            'FechaRegistroServicio' => $FechaRegistroServicio,
                            'HoraLlegadaVehiculo'=> $HoraLlegadaVehiculo,
                            'HoraInicioServicio'=> $HoraInicioServicio,
                            'HoraFinServicio' => $HoraFinServicio,
                            'DirRecojo' => $dirOrigen,
                            'DirDestino' => $dirFin,
                            //DescObservacion,
                            'MontTransporteCred'=> $MontTransporteCred,
                            'IdCliente'=>$id_cliente,
                            'IdUsuarioTransportado' => $id_usuario,
                            'IdTipoServicioSistema' => $id_tipo_servicio,
                            'IdVehiculo' => $id_vehiculo ,
                            'IdMoneda' => $id_moneda,
                            'IdConductor' => $id_conductor,
                            //'IdZonaOrigen' =>,
                            //IdZonaDestino,
                            'IdTipoAuto' => $id_tipo_auto,
                            'ServicioFacturado'=>false,
                            //NumFactura => ,
                            //IdFactura,
                            'IdCarga' => $id_carga,
                            'IdEmpresa'=>$id_empresa,
                            'EsContado' => $esContado?true:false,
                            'EsCredito' => $esContado?false:true
                        ];
                        
                        DB::table('Servicio')->insert($servicios_val_arr);           
                        $cont++;
                        
                    }
                }

            }
            
            $response->status = 1;
            $response->numFilas = $cont;
            $response->carga_id = $id_carga;
            return json_encode($response);

        }
        catch(Exception $ex){
            return 'Exception =>  '. $e->getMessage();
        }

                
    }

    public function GuardarCargaNombre(Request $request){
        
        $data = $request->all();
        DB::table('Carga')->where('IdCarga',$data['id_carga'])->update(['DescCarga'=>$data['nombre_carga']]);
        echo 'hola termino';
    }

}