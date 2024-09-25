<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class tipologiasController extends Controller
{
    public function tipologia(){
        return view('Tipologias.tipologia');
    }
}
