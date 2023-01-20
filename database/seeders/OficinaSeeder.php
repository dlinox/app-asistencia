<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OficinaSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('oficina')->insert([
            'nombre' => 'FACULTAD DE INGENIERIA ECONOMICA',
            'codigo' => 'FC01',
        ]);
        DB::table('oficina')->insert([
            'nombre' => 'FACULTAD DE INGENIERIA ESTADISTICA E INFORMATICA',
            'codigo' => 'FC02',
        ]);
        DB::table('oficina')->insert([
            'nombre' => 'FACULTAD DE INGENIERIA MECANICA ELECTRICA, ELECTRONICA Y SISTEMAS',
            'codigo' => 'FC03',
        ]);
        //
        DB::table('oficina')->insert([
            'nombre' => 'FACULTAD DE CIENCIAS DE LA SALUD',
            'codigo' => 'FC04',
        ]);
        DB::table('oficina')->insert([
            'nombre' => 'FACULTAD DE ENFERMERIA',
            'codigo' => 'FC05',
        ]);
        //sociales
        DB::table('oficina')->insert([
            'nombre' => 'FACULTAD DE CIENCIAS SOCIALES',
            'codigo' => 'FC06',
        ]);

    }
}
