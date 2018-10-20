<?php

namespace App\Http\Controllers;

use App\funci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Redirect;

class funcionarios extends Controller
{
    public function index(){
      $funcionarios = funci::get();
      return view('funcionarios.funcionarios',['funcionarios' => $funcionarios ]);
    }

    public function registrar(Request $request){
        $this->validate($request,[
            'nome' => 'required|max:255',
            'departamento' => 'required|max:255',
            'email' => 'required|email|unique:funcionarios',
            'cpf_cnpj' => 'required|min:14|max:18|unique:funcionarios',
            'telefone' => 'required|min:14|max:15',
            'cep' => 'required|max:9',
            'bairro' => 'required|max:255',
            'cidade' => 'required|max:255',
            'uf' => 'required|max:2',
            'logradouro' => 'required',
            'numero' => 'required|numeric',
            'complemento' => 'max:255',
            'cargo'=> 'required|max:255',
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
            'cargo.required' => 'O cargo é requerido',
        ]);

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
        $senha = Hash::make($request->input('password'));//já faz a hash bcryp
        $cargo = $request->input('cargo');

        $funcionario = new funci();
        $funcionario->fill([
            'nome' => $nome,
            'senha' => $senha,
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

        \Session::flash('sucesso_funcionario', 'Funcionário Registrado com Sucesso!');
        return back()->withInput();
    }


}
