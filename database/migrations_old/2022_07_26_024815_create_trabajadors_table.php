<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadors', function (Blueprint $table) {
            $table->id('tra_id');
            $table->string('tra_nombre', 60);
            $table->string('tra_apellidos', 100);
            $table->string('tra_correo')->unique();
            $table->string('tra_nacionalidad', 60)->nullable();
            $table->char('tra_celular', 20)->nullable();
            $table->string('tra_documento', 40)->unique();

            $table->bigInteger('tra_puesto')->unsigned()->nullable();
            $table->bigInteger('tra_oficina')->unsigned()->nullable();
            $table->bigInteger('tra_horario')->unsigned()->nullable();

            $table->char('tra_codigo', 15)->unique();
            $table->boolean('tra_estado')->default(1);

            $table->foreign('tra_puesto')->references('pue_id')->on('puestos');
            $table->foreign('tra_oficina')->references('ofi_id')->on('oficinas');
            $table->foreign('tra_horario')->references('hor_id')->on('horarios');
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
        Schema::dropIfExists('trabajadors');
    }
}
