<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estado')->insert([
            'nombre' => 'Nuevo',
        ]);
        DB::table('estado')->insert([
            'nombre' => 'Bueno',
        ]);
        DB::table('estado')->insert([
            'nombre' => 'Malo',
        ]);
        DB::table('estado')->insert([
            'nombre' => 'Muy Malo',
        ]);
        DB::table('estado')->insert([
            'nombre' => 'Chatarra',
        ]);
    }
}
