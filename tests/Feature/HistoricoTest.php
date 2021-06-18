<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HistoricoTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    private string $web = '/historico';

    private string $api = '/api/v1/historico';

    private array $search = [];

    private array $register = [
        'data_vacinacao' => '2021/12/12',
        'cod_paciente' => 2,
        'cod_vacina' => 1,
        'id_dose' => '248468111',
        'dose_atual' => 2
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

    public function if_success_register()
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
