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
        $this->call([
            Fabricantes::class,
            Pacientes::class,
            Vacinas::class,
            Historicos::class
        ]);
    }
}
