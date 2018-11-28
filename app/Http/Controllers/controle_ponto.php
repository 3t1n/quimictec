<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class controle_ponto extends Controller
{
    public function index(){
        $data = Carbon::now('America/Sao_Paulo');
    	$ponto = DB::table('ponto')->where('data', $data->toDateString())->get();
        return view('controle_ponto.controle_ponto',['ponto' => $ponto ]);
    }

}
