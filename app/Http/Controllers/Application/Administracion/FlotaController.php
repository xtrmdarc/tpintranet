<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlotaController extends Controller
{
    //
    public function index(){

        //$flota = DB::table('Conductor')

        $data = [];
        return view('contents.Application.Administracion.flota')->with($data);
    }

    

}
