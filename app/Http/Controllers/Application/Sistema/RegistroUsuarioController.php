<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistroUsuarioController extends Controller
{
    //
    public function index()
    {
        return view('contents.Application.Sistema.registrousuario');
    }
}
