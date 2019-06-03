<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtividadesExternas extends Controller
{
    public function index(){
        $data = Carbon::now('America/Sao_Paulo');
        //$ponto = DB::table('ponto')->where('data', $data->toDateString())->get();
        return view('Atividades_Externas.atividades_externas');
    }
}
