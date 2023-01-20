<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('dni',8)->unique();
            $table->string('paterno',60)->nullable();
            $table->string('materno',60)->nullable();
            $table->string('nombres',60)->nullable();
            $table->unsignedBigInteger('id_tipo_persona');
            $table->timestamps();
            $table->foreign('id_tipo_persona')->references('id')->on('tipo_persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
