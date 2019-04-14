<?php

namespace App\Http\Controllers;

use App\fornecedor;
use Illuminate\Http\Request;
use Redirect;

class fornecedores extends Controller
{
  public function index(){
    $fornecedores = fornecedor::get();
      //mostra a pagina de fornecedores
    return view('fornecedores.fornecedores',['fornecedores' => $fornecedores]);
  }

    //Função que Registra um novo Fornecedor
  public function registrar(Request $request){
    $this->validate($request,[
          'nome' => 'required|max:255',
          'email' => 'required|email|unique:fornecedores',
          'cpf_cnpj' => 'required|min:14|max:18|unique:fornecedores',
          'telefone' => 'required|min:14|max:15',
          'cep' => 'required|max:9',
          'bairro' => 'required|max:255',
          'cidade' => 'required|max:255',
          'uf' => 'required|max:2',
          'logradouro' => 'required',
          'numero' => 'required|numeric',
          'complemento' => 'max:255',
          'produto' => 'required'
      ],[
          'email.unique' => 'O email já está cadastrado!',
          'cpf_cnpj.unique' => 'O cpf ou cnpj já está cadastrado!',
          'nome.required' => 'O nome é requerido',
          'email.required' => 'O email é requerido',
          'cpf_cnpj.required' => 'O cpf/cnpj é requerido',
          'telefone.required' => 'O telefone é requerido',
          'cep.required' => 'O cep é requerido',
          'bairro.required' => 'O bairro é requerido',
          'cidade.required' => 'O cidade é requerido',
          'uf.max' => 'O uf é requerido',
          'logradouro.required' => 'O logradouro é requerido',
          'numero.required' => 'O numero é requerido',
          'produto.requered' => 'O produto é requerido',
      ]);

      $nome = $request->input('nome');
      $email = $request->input('email');
      $cpf_cnpj = $request->input('cpf_cnpj');
      $telefone = $request->input('telefone');
      $cep = $request->input('cep');
      $bairro = $request->input('bairro');
      $cidade = $request->input('cidade');
      $uf = $request->input('uf');
      $logradouro = $request->input('logradouro');
      $numero = $request->input('numero');
      $complemento = $request->input('complemento');
      $produto = $request -> input('produto');

      $fornecedores = new fornecedor();
      $fornecedores->fill([
          'nome' => $nome,
          'email' => $email,
          'cpf_cnpj' => $cpf_cnpj,
          'telefone' => $telefone,
          'cep' => $cep,
          'bairro' => $bairro,
          'cidade' => $cidade,
          'uf' => $uf,
          'logradouro' => $logradouro,
          'numero' => $numero,
          'complemento' => $complemento,
          'produto' => $produto,
      ]);
      $fornecedores->save();
        //Retorna uma mensagem para o usúario dizendo que o fornecedor foi registrado
      \Session::flash('sucesso_fornecedores', 'Fornecedor Registrado com Sucesso!');
      return back()->withInput();
    }


}
