<?php

namespace Database\Seeders;

use App\Models\Fabricante;
use Illuminate\Database\Seeder;

class Fabricantes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registers = [
            ['nome' => 'Instituto Butantan', 'cnpj' => '12345678910111', 'qtd_dose_disponivel' => 1000000]
        ];

        foreach ($registers as $register) { Fabricante::create($register); };
    }
}
