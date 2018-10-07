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
        $this->validate($request,[
            'nome' => 'required|max:255',
            'email' => 'required|email|unique:funcionarios',
            'password' => 'required|min:6',
        ],[
            'email.unique' => 'O email já está cadastrado!',
            'nome.required' => 'O nome é requerido',
            'email.required' => 'O email é requerido',
            'password.required' => 'A senha é requerida',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
        ]);

        $nome = $request->input('nome');
        $email = $request->input('email');
        $senha = Hash::make($request->input('password')); //já faz a hash bcryp
        $funcionario = new funci();
        $funcionario->fill([
            'nome' => $nome,
            'senha' => $senha,
            'departamento' => 'teste',
            'cargo'=> 'teste',
            'email' => $email,
            'cpf' => '1222',
            'telefone' => '11555226554',
            'cep' => '03585850',
            'bairro' => 'teste',
            'cidade' => 'teste',
            'uf' => 'teste',
            'logradouro' => 'teste',
            'numero' => '456564' ,
            'complemento' => 'xzdadsdas',
        ]);
        $funcionario->save();

        \Session::flash('sucesso_funcionario', 'Funcionário Registrado com Sucesso!');
        return Redirect::to('/funcionarios');
    }

}
