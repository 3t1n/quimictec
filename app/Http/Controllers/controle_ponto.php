<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class controle_ponto extends Controller
{
    public function index(){
        $data = Carbon::now('America/Sao_Paulo');
        //chamada da tablea ponto por data
    	$ponto = DB::table('ponto')->where('data', $data->toDateString())->get();
        //mostra a pagina de controle de ponto
        return view('controle_ponto.controle_ponto',['ponto' => $ponto ]);

    }

}
