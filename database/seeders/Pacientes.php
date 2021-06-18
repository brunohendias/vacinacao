<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Seeder;

class Pacientes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $registers = [
            ['nome' => 'Fernandez da Silva', 'cpf' => '12345678910',
                'rg' => '132456789', 'telefone' => '31998765432'],
            ['nome' => 'Ana Eliza da Silva', 'cpf' => '10987654321',
                'rg' => '987654321', 'telefone' => '23456789101']
        ];

        foreach ($registers as $register) { Paciente::create($register); };
    }
}
