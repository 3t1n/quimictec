<?php

namespace App\Http\Controllers;

use App\funci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Redirect;

class funcionarios extends Controller
{
    public function index(){
        return view('funcionarios.funcionarios');
    }
    public function registrar(Request $request){
/*
precisa alterar os campos
        $this->validate($request,[
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:funcionarios',
            'password' => 'required|min:6',
        ],[
            'email.unique' => 'O email já está cadastrado!',
            'nome.required' => 'O nome é requerido',
            'email.required' => 'O email é requerido',
            'password.required' => 'A senha é requerida',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres'
        ]);*/

        $nome = $request->input('nome');
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
        $senha = Hash::make($request->input('password')); //já faz a hash bcryp

        $funcionario = new funci();
        $funcionario->fill([
            'nome' => $nome,
            'senha' => $senha,
            'departamento' => $departamento,
            'cargo'=> 'teste',
            'email' => $email,
            'cpf' => $cpf_cnpj,
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

        \Session::flash('sucesso_funcionario', 'Funcionário Registrado com Sucesso!');
        return Redirect::to('/funcionarios');
    }

}
