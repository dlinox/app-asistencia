<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventario', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo',50);
            $table->string('codigo_anterior',50);
            $table->string('nombre', 130);
            $table->string('modelo',60);
            $table->string('numero',60);
            $table->string('marca',60)->nullable();
            $table->string('serie',60);
            $table->string('idbienk',60);
            $table->unsignedBigInteger('id_persona');
            $table->integer('idpersona_otro');
            $table->unsignedBigInteger('id_area');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_estado');
            $table->string('observaciones',150);
            $table->timestamps();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->foreign('id_area')->references('id')->on('area');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_estado')->references('id')->on('estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventario');
    }
}
