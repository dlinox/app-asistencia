<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('asi_id');
            $table->time('asi_entrada')->nullable();
            $table->time('asi_salida')->nullable()->nullable();   
            $table->enum('asi_estado', ['Falta', 'Tarde', 'Puntual'])->default('Falta');
            $table->integer('asi_horas_trabajo')->default(0);
            $table->date('asi_fecha')->nullable();
            $table->date('asi_mes')->nullable();
            $table->bigInteger('asi_trabajador')->unsigned();
            $table->foreign('asi_trabajador')->references('tra_id')->on('trabajadors')->onDelete('cascade');
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
        Schema::dropIfExists('asistencias');
    }
}
