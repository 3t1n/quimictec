<?php

namespace App\Http\Controllers;

use App\configuracoes;
use Illuminate\Http\Request;

class ConfiguracoesController extends Controller
{
    public function index(){
        $configuracoes = configuracoes::get();
        //mostra a pagina de estoque
        return view('configuracoes.configuracoes',['configuracoes' => $configuracoes ]);
    }
    public function registrar(Request $request){

        $request->validate([
            'latitude' => 'required|max:9|min:8',
            'longitude' => 'required|max:9|min:8',
        ],[
            'latitude.required' => 'A latitude é requerida',
            'longitude.required' => 'A longitude é requerida',
        ]);

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
    public function deletar($id){
        $estoque = configuracoes::findOrFail($id);
        $estoque->delete();
        \Session::flash('sucesso_configuracoes', 'Configuração deletada com Sucesso!');
        return back()->withInput();
    }
}
