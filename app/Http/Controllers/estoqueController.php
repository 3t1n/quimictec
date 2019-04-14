<?php

namespace App\Http\Controllers;

use App\estoque;
use Illuminate\Http\Request;
use Redirect;

class estoqueController extends Controller
{
    public function index(){
      $estoque = estoque::get();
        ////mostra a pagina de estoque
      return view('estoque.estoque',['estoque' => $estoque ]);
    }

    //Função pata Registrar o Produto/Quantidade
    public function registrar(Request $request){
        $this->validate($request,[
            'quantidade' => 'required|max:255',
            'produto' => 'required',
          ],[
            'produto.required' => 'O produto é requerido',
            'quantidade.required' => 'A quantidade é requerida',
            ]);

        $nome_prod = $request->input('produto');
        $qtd_prod = $request->input('quantidade');

        $estoque = new estoque();
        $estoque->fill([
            'nome_prod' => $nome_prod,
            'qtd_prod' => $qtd_prod,
        ]);
        $estoque->save();
        
        //Retorna uma mensagem para o usúario dizendo que o produto foi registrado
        \Session::flash('sucesso_estoque', 'Produto Registrado com Sucesso no Estoque!');
        return back()->withInput();
    }
    // Função de que deleta o produto do estoque.
    public function deletar($id){
        $estoque = estoque::findOrFail($id);
        $estoque->delete();
        \Session::flash('sucesso_estoque', 'Produto deletado com sucesso!');
        return back()->withInput();
    }
    

}
