<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolesPermitir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permitir', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->integer('permitir_id')->unsigned();
        });
        Schema::table('roles_permitir', function($table) {
            $table->foreign('role_id')->references('id')->on('role');
        });
        Schema::table('roles_permitir', function($table) {
            $table->foreign('permitir_id')->references('id')->on('permitir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permitir');
    }
}
