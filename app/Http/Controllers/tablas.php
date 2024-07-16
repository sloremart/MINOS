<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tablas extends Controller
{
    public function tablas(){
        return view('tablas.tablaIndex');
    }
}
