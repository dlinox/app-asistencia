<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(UsuariosDemo::class);
        $this->call(TipoPersonaSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(OficinaSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(GrupoSeeder::class);
        $this->call(EstadoSeeder::class);
        $this->call(BienkSeeder::class);

    }
}
