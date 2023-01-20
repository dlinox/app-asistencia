<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persona')->insert([
            'dni' => '70482270',
            'paterno' => 'MALDONADO',
            'materno' => 'BERRIOS',
            'nombres' => 'EMMANUEL ADRIAN',
            'id_tipo_persona' => 1,
        ]);
        DB::table('persona')->insert([
            'dni' => '70460951',
            'paterno' => 'ZAMBRANO',
            'materno' => 'LAURA',
            'nombres' => 'SANTIAGO ELIAS',
            'id_tipo_persona' => 1,
        ]);
        DB::table('persona')->insert([
            'dni' => '70833861',
            'paterno' => 'VALENCIA',
            'materno' => 'GOMEZ',
            'nombres' => 'JHOAN ENRIQUE',
            'id_tipo_persona' => 2,
        ]);
        DB::table('persona')->insert([
            'dni' => '75944544',
            'paterno' => 'MAQUERA',
            'materno' => 'ESCOBAR',
            'nombres' => 'JHEFFERSON EMANUEL',
            'id_tipo_persona' => 2,
        ]);
        DB::table('persona')->insert([
            'dni' => '70895294',
            'paterno' => 'ALVAREZ',
            'materno' => 'CHAMBILLA',
            'nombres' => 'OLIVER ANDRÉ',
            'id_tipo_persona' => 3,
        ]);
        DB::table('persona')->insert([
            'dni' => '76619496',
            'paterno' => 'GOMEZ',
            'materno' => 'ZAPANA',
            'nombres' => 'NEIL LUIS BENJAMIN',
            'id_tipo_persona' => 1,
        ]);
        DB::table('persona')->insert([
            'dni' => '72752127',
            'paterno' => 'ROSAS',
            'materno' => 'MAMANI',
            'nombres' => 'JOSELIN CYNTHIA',
            'id_tipo_persona' => 1,
        ]);
        DB::table('persona')->insert([
            'dni' => '71140749',
            'paterno' => 'CHURA',
            'materno' => 'ALARCON',
            'nombres' => 'HUAMAN CHUNE ADRIAN MARCELO',
            'id_tipo_persona' => 1,
        ]);


    }
}
