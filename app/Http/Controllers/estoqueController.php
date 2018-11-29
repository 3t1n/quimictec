<?php

namespace App\Http\Controllers;

use App\estoque;
use Illuminate\Http\Request;
use Redirect;

class estoqueController extends Controller
{
    public function index(){
      $estoque = estoque::get();
      return view('estoque.estoque',['estoque' => $estoque ]);
    }

    public function registrar(Request $request){
        $this->validate($request,[
            'nome_prod' => 'required|max:255',
            'qtd_prod' => 'required',
          ],[
            'nome.required' => 'O nome é requerido',
            'qtd_prod.required' => 'A quantidade é requerida',
            ]);

        $nome_prod = $request->input('nome_prod');
        $qtd_prod = $request->input('qtd_prod');

        $estoque = new estoque();
        $estoque->fill([
            'nome_prod' => $nome_prod,
            'qtd_prod' => $qtd_prod,
        ]);
        $estoque->save();

        \Session::flash('sucesso_estoque', 'Produto Registrado com Sucesso no Estoque!');
        return back()->withInput();
    }

}
