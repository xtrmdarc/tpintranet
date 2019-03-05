<?php

namespace App\Http\Controllers\Landing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    //
    public function EmpresaLanding()
    {
        return view('contents.Landing.landing_page_empresas');
    }
}
