<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjusteTurnoController extends Controller
{
    public function index()
    {
        // $data['Turnos'] = Turno::lists('name','id');
        // return view('pais.index',$data);
    }

    public function listar_turnos()
    {
        $turnos=DB::table('Turno')->paginate(10);
        $data=['turnos'=>$turnos];
        return view('contents.application.sistema.listaturnos')->with($data);
    }

    public function editar_turnos($id_turno=null)
    {
        $turno = DB::table('Turno')->where('IdTurnoSistema',$id_turno)->first();
       
        $tipoturno = DB::table('TipoTurno')->get();

        $data=
        [
            'turno' => $turno,
            'idturno'=>$turno?$turno->IdTurnoSistema:'',
            'tipoturno'=>$tipoturno
        ];
        
        return view('contents.application.sistema.editorturnos')->with($data);
    }

    public function eliminar_turnos($id_turno)
    {
        $turno = DB::table('Turno')->where('IdTurnoSistema',$id_turno)->first();
        $turnos=DB::table('Turno')->paginate(10);
        $data=[ 'turnos'=>$turnos];
        return view('contents.application.sistema.listaturnos')->with($data);
    }

    public function RegistroTurnoRequest(Request $request)
    {
        $data = $request->all();

        $DescTurno=$data['descturno'];
        $IdTipoTurnoSistema=$data['idtturno'];

        $horainicio=$data['horainicio'];
        $horafin=$data['horafin'];

        $HoraInicio=time('HH:mm',date_create_from_format('HH:mm',trim($horainicio))->getTimestamp());
        $HoraFin=time('HH:mm',date_create_from_format('HH:mm',trim($horafin))->getTimestamp());

        if($data['idturno']!="")
        {
            DB::table('Turno')->where('IdTurnoSistema', $data["idturno"])->update
            (
                [
                    'HoraInicio'=>$HoraInicio,
                    'HoraFin'=>$HoraFin,
                    'DescTurno'=>$DescTurno,
                    'IdTipoTurnoSistema'=>$IdTipoTurnoSistema,
                ]
               
            );
        }

        else

        {
            DB::table('Turno')->insert
            (
                [
                    'HoraInicio'=>$HoraInicio,
                    'HoraFin'=>$HoraFin,
                    'DescTurno'=>$DescTurno,
                    'IdTipoTurnoSistema'=>$IdTipoTurnoSistema,
                ]
            );
            
        }

        $turnos=DB::table('Turno')->paginate(10);
        $data2=[ 'turnos'=>$turnos];
        return view('contents.application.sistema.listaturnos')->with($data2);
    }
}