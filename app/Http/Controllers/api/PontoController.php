<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PontoController extends Controller
{
    public function ponto(Request $request){
        $hora = $request->input('hora');

    }
}
