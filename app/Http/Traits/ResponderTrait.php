<?php
namespace App\Http\Traits;

trait ResponderTrait {

    /**
     * Metodo para retorno de sucesso 
     * @return \Illuminate\Http\Response
     */
    protected function RespSuccess(array $dados)
    {
        return responder()->success($dados);
    }

    /**
     * Metodo para retorno de falha
     * Exemplos: no-content, bad-request
     * @return \Illuminate\Http\Response
     */
    protected function RespErrorNormal(string $msg = null, int $code = 400)
    {
		return responder()->error($code, $msg ?? __('return.empty'));
	}

    /**
     * Metodo para retorno de erro: Exception, Log
     * Metodo para enviar o log para o Kibana por exemplo
     * Exemplos: Table or View dosen't exists
     * @return \Illuminate\Http\Response
     */
    protected function RespLogErro(object $e, string $msg = null, int $code = 500)
    {
        return responder()->error($code, $msg ?? __('return.internalerror'));
    }
}