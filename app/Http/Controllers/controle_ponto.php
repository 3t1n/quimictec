<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controle_ponto extends Controller
{
    public function index(){
        return view('controle_ponto.controle_ponto');
    }
}
