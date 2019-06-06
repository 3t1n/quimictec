<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

class Inicial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Role::create([
            'id'            => 1,
            'nome'          => 'Root',
            'descricao'   => 'Pode fazer qualquer coisa no sistema'
        ]);
        Role::create([
            'id'            => 2,
            'nome'          => 'Suporte',
            'descricao'   => 'Cria edita e modifica'
        ]);
        Role::create([
            'id'            => 3,
            'nome'          => 'RH',
            'descricao'   => 'Aciona usuários e controla o ponto'
        ]);
        Role::create([
            'id'            => 4,
            'nome'          => 'Gerente',
            'descricao'   => 'Acessa áreas gerenciais'
        ]);
        Role::create([
            'id'            => 5,
            'nome'          => 'Usuário',
            'descricao'   => 'Usuário simples'
        ]);
        User::create([
            'id'  => 1,
            'name'  => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt("teste1234"),
            'cargo' => 'gerente',
            'role_id' => 1,
        ]);

    }
}
