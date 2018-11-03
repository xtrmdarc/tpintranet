<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MacroPagoController extends Controller
{
    //
    public function index()
    {
        return view('contents.Application.Administracion.macro_pago');
    }

    public function ObtenerMacrosPago(Request $request){

        $data = $request->all();
        
    }

}
