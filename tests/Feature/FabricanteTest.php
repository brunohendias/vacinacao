<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FabricanteTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    private string $web = '/fabricante';

    private string $api = '/api/v1/fabricante';

    private array $search = [];

    private array $register = [
        'nome' => 'Fabricante phpunit',
        'cnpj' => '11109876543211',
        'qtd_dose_disponivel' => 50000
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
