<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('token')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('cargo')->nullable();
            $table->string('cpf_cnpj')->unique()->nullable();;
            $table->string('telefone')->nullable();
            $table->string('cidade')->nullable();
            $table->string('cep')->nullable();
            $table->string('bairro')->nullable();
            $table->string('uf')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('departamento')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('ativo_inativo')->default('ativo');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
