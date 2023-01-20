<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSeeder extends Seeder{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        DB::table('grupo')->insert([
            'id_area' => 1,
            'id_usuario' => 3,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 2,
            'id_usuario' => 3,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 3,
            'id_usuario' => 3,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 4,
            'id_usuario' => 3,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 5,
            'id_usuario' => 3,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 6,
            'id_usuario' => 3,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 12,
            'id_usuario' => 3,
        ]);


        DB::table('grupo')->insert([
            'id_area' => 7,
            'id_usuario' => 4,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 8,
            'id_usuario' => 4,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 9,
            'id_usuario' => 4,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 10,
            'id_usuario' => 4,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 11,
            'id_usuario' => 4,
        ]);


        DB::table('grupo')->insert([
            'id_area' => 13,
            'id_usuario' => 5,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 14,
            'id_usuario' => 5,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 15,
            'id_usuario' => 5,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 16,
            'id_usuario' => 5,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 17,
            'id_usuario' => 5,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 18,
            'id_usuario' => 5,
        ]);
        DB::table('grupo')->insert([
            'id_area' => 19,
            'id_usuario' => 5,
        ]);
    }
}
