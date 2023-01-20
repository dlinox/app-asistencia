<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBienkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo',50);
            $table->string('codigo_anterior',50);
            $table->string('nombre', 130);
            $table->string('modelo',60)->nullable();
            $table->string('numero',60)->nullable();
            $table->string('serie',60)->nullable();
            $table->unsignedBigInteger('id_persona');
            $table->integer('idpersona_otro')->nullable();
            $table->unsignedBigInteger('id_area');
            $table->unsignedBigInteger('id_estado');
            $table->string('observaciones',150)->nullable();
            $table->timestamps();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->foreign('id_area')->references('id')->on('area');
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
        Schema::dropIfExists('bienk');
    }
}
