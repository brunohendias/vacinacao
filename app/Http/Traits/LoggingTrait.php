<?php
namespace App\Http\Traits;

use Illuminate\Support\Facades\Log;

trait LoggingTrait {

    /**
     * Metodo para loggar sucesso em uma operacao
     * @param string $metodo
     * @param int $code = 200
     * @return void
     */
    protected static function LogSuccess(string $metodo, int $code = 200)
    {
        Log::info(__('logging.info'), [
            'codigo' => $code,
            'metodo' => $metodo
        ]);
    }

    /**
     * Metodo para loggar uma falha
     * Exemplos: no-content, bad-request
     * @param string $metodo
     * @param int $code = 400
     * @param string $msg = null
     * @return void
     */
    protected static function LogFail(string $metodo, int $code = 400, string $msg = null)
    {
        Log::notice(__('logging.notice'), [
            'codigo' => $code,
            'metodo' => $metodo,
            'msg' => $msg
        ]);
	}

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
            'error' => $e->getMessage()
        ]);
    }
}