<?php

namespace Database\Seeders;

use App\Models\Vacina;
use Illuminate\Database\Seeder;

class Vacinas extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registers = [
            ['nome' => 'Coronavac','cod_fabricante' => 1, 'lote' => '2684484485', 'data_validade' => date('Y/m/d'),
             'qtd_recebida' => 100000, 'qtd_atual' => 38000, 'intervalo_min' => 45]
        ];

        foreach ($registers as $register) { Vacina::create($register); };
    }
}
