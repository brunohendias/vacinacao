<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;

trait LoggingTrait {

    /**
     * Metodo para loggar um erro: Exception, Log
     * Metodo para enviar o log para o Kibana por exemplo
     * Exemplos: Table or View dosen't exists
     * @param object $e
     * @param int $code = 500
     * @param string $msg = 200
     * @return void
     */
    protected static function LogError(object $e, int $code = 500, string $msg = null)
    {
        Log::error(__('logging.error'), [
            'codigo' => $code,
            'msg' => $msg,
            'referer' => $_SERVER['REQUEST_URI'],
            'metodo' => $_SERVER['REQUEST_METHOD'],
            'error' => $e->getMessage()
        ]);
    }
}