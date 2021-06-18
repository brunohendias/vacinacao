<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PacienteTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    private string $web = '/paciente';

    private string $api = '/api/v1/paciente';

    private array $search = [];

    private array $register = [
        'nome' => 'Paciente teste',
        'cpf' => '66848646884',
        'rg' => '135848887',
        'telefone' => '31998765432'
    ];

    public function test_if_success_get()
    {
        $this->get($this->web)->assertStatus(200);
    }

    public function test_if_success_find()
    {
        $this->get($this->api.'/1')->assertStatus(200);
    }

    public function test_if_fail_find()
    {
        $this->get($this->api.'/0')->assertStatus(404);
    }

    public function test_if_success_register()
    {
        $this->postJson($this->web, $this->register)->assertStatus(302);
    }

    public function test_if_fail_register()
    {
        $keys = array_keys($this->register);
        foreach ($keys as $key) {
            $copy = $this->register;
            $copy[$key] = null;

            $this->postJson($this->web, $copy)->assertStatus(422);
        }
    }
}
