<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('area')->insert([
            'nombre' => 'BIBLIOTECA DE ING. ECONOMICA',
            'id_oficina' => 1,
        ]);
        DB::table('area')->insert([
            'nombre' => 'COORDINACION ACADEMICA DE ING. ECONÓMICA',
            'id_oficina' => 1,
        ]);
        DB::table('area')->insert([
            'nombre' => 'DIRECCION DE ING. ECONÓMICA',
            'id_oficina' => 1,
        ]);
        DB::table('area')->insert([
            'nombre' => 'BIBLIOTECA DE ING. ESTADISTICA',
            'id_oficina' => 2,
        ]);
        DB::table('area')->insert([
            'nombre' => 'SECRETARIA DE ING. ESTADISTICA',
            'id_oficina' => 2,
        ]);
        DB::table('area')->insert([
            'nombre' => 'DIRECCION ING. ESTADISTICA',
            'id_oficina' => 2,
        ]);
        DB::table('area')->insert([
            'nombre' => 'DIRECCION DE ING. DE SISTEMAS',
            'id_oficina' => 3,
        ]);
        DB::table('area')->insert([
            'nombre' => 'LABORATORIO 1 ING. SISTEMAS',
            'id_oficina' => 3,
        ]);
        DB::table('area')->insert([
            'nombre' => 'LABORATORIO 2 ING. SISTEMAS',
            'id_oficina' => 3,
        ]);
        DB::table('area')->insert([
            'nombre' => 'BIBLIOTECA DE ING. DE SISTEMAS',
            'id_oficina' => 3,
        ]);
        DB::table('area')->insert([
            'nombre' => 'OFICINA DE CONSEJERIA NUTRICIONAL',
            'id_oficina' => 4,
        ]);
        DB::table('area')->insert([
            'nombre' => 'CONSULTORIO CRED',
            'id_oficina' => 5,
        ]);
        DB::table('area')->insert([
            'nombre' => 'TRIAJE',
            'id_oficina' => 5,
        ]);
        DB::table('area')->insert([
            'nombre' => 'CONSUTORIO DE TUBERCULOSIS',
            'id_oficina' => 5,
        ]);
        DB::table('area')->insert([
            'nombre' => 'AREA DE INMUNIZACIONES',
            'id_oficina' => 5,
        ]);
        DB::table('area')->insert([
            'nombre' => 'TOPICO',
            'id_oficina' => 5,
        ]);
        DB::table('area')->insert([
            'nombre' => 'BIBLIOTECA DE SOCIOLOGÍA',
            'id_oficina' => 6,
        ]);
        DB::table('area')->insert([
            'nombre' => 'SECRETARIA DE SOCIOLOGÍA',
            'id_oficina' => 6,
        ]);
        DB::table('area')->insert([
            'nombre' => 'DIRECCION DE SOCIOLOGÍA',
            'id_oficina' => 6,
        ]);

    }
}
