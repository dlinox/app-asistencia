<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre', 100);
            $table->unsignedBigInteger('id_oficina');
            $table->unsignedBigInteger('id_persona')->nullable();
            $table->boolean('stado')->default(1)->nullable();
            $table->timestamps();
            $table->foreign('id_persona')->references('id')->on('persona');
            $table->foreign('id_oficina')->references('id')->on('oficina');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area');
    }
}
