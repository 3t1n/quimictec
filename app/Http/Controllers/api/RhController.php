<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Redirect;

class RhController extends Controller
{
    public function recrutamento(Request $request){

      $this->validate($request,[
          'name' => 'required|max:255',
          'departamento' => 'required|max:255',
          'email' => 'required|email|unique:users',
          'cpf_cnpj' => 'required|min:14|max:18|unique:user',
          'telefone' => 'required|min:14|max:15',
          'cep' => 'required|max:9',
          'bairro' => 'required|max:255',
          'cidade' => 'required|max:255',
          'uf' => 'required|max:2',
          'logradouro' => 'required',
          'numero' => 'required|numeric',
          'complemento' => 'max:255',
          'cargo'=> 'required|max:255',
          'salario' => 'required',
          'password' => 'required|min:4',
      ]);

      $nome = $request->input('name');
      $departamento = $request->input('departamento');
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
      $senha = Hash::make($request->input('password'));//já faz a hash bcryp
      $salario = $request->input('salario');
      $cargo = $request->input('cargo');
      $funcionario = new User();
      $funcionario->fill([
          'name' => $nome,
          'password' => $senha,
          'salario' => $salario,
          'departamento' => $departamento,
          'cargo'=> $cargo,
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
      ]);
      $funcionario->save();
      return response([
          'status' => 'success',
          'user' => $nome,
          "departamento" => $departamento,
          'cargo' =>  $cargo,
          'msg' => 'Funcionário cadastrado com sucesso!'
      ]);
    }

    public function editSalario(Request $request) {
      $this->validate($request,[
        'nome' => 'required',
        'salario' => 'required',
        ]);

      $nome = $request->input('nome');
      $salario = $request->input('salario');

      $user = new User();
      $user->update([
        'name' => $nome,
        'salario' => $salario,
      ]);
      $user->save();
    }
}
