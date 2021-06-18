<?php

namespace Database\Seeders;

use App\Models\Historico;
use Illuminate\Database\Seeder;

class Historicos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registers = [
            ['data_vacinacao' => date('Y/m/d'), 'cod_paciente' => 1, 'cod_vacina' => 1, 
            'data_prox_vaci' => date("Y-m-d", strtotime(date('Y/m/d').' +45 days')),
            'id_dose' => '248468111']
        ];

        foreach ($registers as $register) { Historico::create($register); };
    }
}
