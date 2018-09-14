<?php

namespace App\Http\Controllers\Application\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjusteUsuariosController extends Controller
{
    //
    public function index()
    {
        return view ('contents.application.sistema.editorusuarios');
    }

    public function cargasistemausuario()
    {
        
    }
}
