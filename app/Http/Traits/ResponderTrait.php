<?php
namespace App\Http\Traits;

use App\Http\Traits\LoggingTrait;

trait ResponderTrait {

    /**
     * Metodo para retorno de sucesso 
     * @param array $dados
     * return \Illuminate\Http\Response
     */
    protected function RespSuccess(array $dados)
    {
        return responder()->success($dados);
    }

    /**
     * Metodo para retorno de falha
     * Exemplos: no-content, bad-request
     * @param string $msg = null
     * @param int $code = 400
     * @return \Illuminate\Http\Response
     */
    protected function RespErrorNormal(string $msg = null, int $code = 400)
    {
        $msg = $msg ?? __('return.empty');
		return responder()->error($code, $msg);
	}

    /**
     * Metodo para retorno de erro: Exception, Log
     * Metodo para enviar o log para o Kibana por exemplo
     * Exemplos: Table or View dosen't exists
     * @param object $e
     * @param string $msg = null
     * @param int $code = 500
     * @return \Illuminate\Http\Response
     */
    protected function RespLogErro(object $e, string $msg = null, int $code = 500)
    {
        $msg = $msg ?? __('return.internalerror');
        LoggingTrait::LogError($e, $code, $msg);
        return responder()->error($code, $msg);
    }
}