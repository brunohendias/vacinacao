<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VacinaTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    private string $web = '/vacina';

    private string $api = '/api/v1/vacina';

    private array $search = [];

    private array $register = [
        'nome' => 'Vacina teste',
        'cod_fabricante' => 1,
        'lote' => '2247885485',
        'data_validade' => '2021-12-12',
        'qtd_recebida' => 7000,
        'qtd_atual' => 2000,
        'intervalo_min' => 15
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
