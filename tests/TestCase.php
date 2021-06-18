<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public array $success = [
        'status' => 200,
        'success' => true 
    ];
    
    public array $error = [
        'status' => 500,
        'success' => false
    ];
}
