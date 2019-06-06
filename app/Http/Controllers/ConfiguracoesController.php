<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\configuracoes;

class ConfiguracoesController extends Controller
{
    public function index(){
        $configuracoes = configuracoes::get();
        //mostra a pagina de estoque
        return view('configuracoes.configuracoes',['configuracoes' => $configuracoes ]);
    }
    public function registrar(Request $request){
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $configuracoes =configuracoes::updateOrCreate([
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);
        $configuracoes->save();
        \Session::flash('sucesso_configuracoes', 'Configuração registrada com Sucesso!');
        return back()->withInput();
    }
}
