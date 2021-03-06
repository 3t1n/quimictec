<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Redirect;

class funcionarios extends Controller
{
    public function index(){
      $funcionarios = User::get();
        //mostra a pagina de Funcionarios
      return view('funcionarios.funcionarios',['funcionarios' => $funcionarios ]);
    }
    
        //Função pata Registrar um Funcionario novo
    public function registrar(Request $request){
        $this->validate($request,[
            'nome' => 'required|max:255',
            'departamento' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'cpf_cnpj' => 'required|min:14|max:18|unique:users',
            'telefone' => 'required|min:14|max:15',
            'cep' => 'required|max:9',
            'bairro' => 'required|max:255',
            'cidade' => 'required|max:255',
            'uf' => 'required|max:2',
            'logradouro' => 'required',
            'numero' => 'required|numeric',
            'complemento' => 'max:255',
            'cargo'=> 'required|max:255',
            'role' => 'required',
          ],[
            'role.required' => 'A permisão é requerida',
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

        $role = $request->input('role');
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
        $senha = Hash::make($request->input('passowrd'));//já faz a hash bcryp
        $cargo = $request->input('cargo');

        $funcionario = new User();
        $funcionario->fill([
            'name' => $nome,
            'password' => $senha,
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
            'role_id' => $role
        ]);
        $funcionario->save();
        
          //Retorna uma mensagem para o usúario dizendo que o funcionario foi registrado
        \Session::flash('sucesso_funcionario', 'Funcionário Registrado com Sucesso!');
        return back()->withInput();
    }

    //Função que demonstra se o Funcionario está ativo ou não
    public function status($id) {
    $ativo = User::find($id)->where('ativo_inativo', 'ativo')->first();
    $inativo = User::find($id)->where('ativo_inativo', 'inativo')->first();
     if($ativo != null){
       if($ativo->ativo_inativo == 'ativo') {
        $ativo->ativo_inativo = 'inativo';
        $ativo->save();

       }
     }
     if($inativo != null){
       if ($inativo->ativo_inativo == 'inativo') {
         $inativo->ativo_inativo = 'ativo';
         $inativo->save();
     }

    }
    return redirect()->back()->withInput();
  }

    // Função de que deleta o funcionario
  public function deletar($id){
    $funcionario = User::findOrFail($id);
    $funcionario->delete();
    return back()->withInput();
}

}
