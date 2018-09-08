<?php

namespace App\Http\Controllers\Application\Administracion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ControlFacturacionController extends Controller
{
    //
    public function index()
    {
        return view('contents.Application.Administracion.control_facturacion');
    }
    
}
