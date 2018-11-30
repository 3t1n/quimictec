<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePonto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('ponto', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nome');
          $table->string('latitude');
          $table->string('longitude');
          $table->string('id_usuario');
          $table->date('data');
          $table->string('horario');
          $table->string('controle');
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
        Schema::dropIfExists('ponto');
    }
}
