<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class TipoPersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_persona')->insert([
            'nombre' => 'docente',
        ]);
        DB::table('tipo_persona')->insert([
            'nombre' => 'administrativo',
        ]);
        DB::table('tipo_persona')->insert([
            'nombre' => 'C.A.S.',
        ]);

    }
}
