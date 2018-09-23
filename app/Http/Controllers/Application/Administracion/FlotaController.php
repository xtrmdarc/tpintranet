<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FlotaController extends Controller
{
    //
    public function index(){

        $flota = DB::table('v_adm_flota')->paginate(10);

        $data = [
            'flota' => $flota
        ];
        return view('contents.Application.Administracion.flota')->with($data);
    }

    

}
