<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFornecedor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('fornecedores', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->string('email')->unique();
          $table->string('cpf_cnpj')->unique();
          $table->string('telefone');
          $table->string('cidade');
          $table->string('cep');
          $table->string('bairro');
          $table->string('uf');
          $table->string('logradouro');
          $table->string('numero');
          $table->string('complemento')->nullable();
          $table->string('produto');
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
        Schema::dropIfExists('fornecedores');
    }
}
