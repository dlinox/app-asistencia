<?php

namespace Database\Seeders;

use App\Models\Oficina;
use Illuminate\Database\Seeder;

class OficinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Oficina::create([
            'nombre' => 'Oficina 1',
            'descripcion' => 'Descripcion de la oficina 1',
        ]);

        Oficina::create([
            'nombre' => 'Oficina 2',
            'descripcion' => 'Descripcion de la oficina 2',
        ]);

        Oficina::create([
            'nombre' => 'Oficina 3',
            'descripcion' => 'Descripcion de la oficina 3',
        ]);
    }
}
