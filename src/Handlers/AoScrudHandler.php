<?php

namespace AoScrud\Handlers;

use AoScrud\Console\DBDropCommand;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait AoScrudHandler
{

    /**
     * https://httpstatusdogs.com/
     */
    private $descriptions = [
        100 => 'CONTINUE',
        ###
        200 => 'OK', // Requisição realizadao com sucesso.
        201 => 'CREATED', // Registro criado com sucesso.
        202 => 'ACCEPTED', // Requisição foi aceita e colocada na fila.
        203 => 'NON_AUTHORITATIVE_INFORMATION',
        204 => 'NO_CONTENT', // Pedido foi processado, mas não há informações a serem devolvidas.
        205 => 'RESET_CONTENT',
        206 => 'PARTIAL_CONTENT',
        207 => 'MULTI_STATUS',
        208 => 'ALREADY_REPORTED',
        226 => 'IM_USED',
        ###
        300 => 'MULTIPLE_CHOICES',
        301 => 'MOVED_PERMANENTLY',
        302 => 'FOUND',
        303 => 'SEE_OTHER',
        304 => 'NOT_MODIFIED',
        305 => 'USE_PROXY',
        306 => 'SWITCH_PROXY',
        307 => 'TEMPORARY_REDIRECT',
        308 => 'PERMANENT_REDIRECT',
        ###
        400 => 'BAD_REQUEST', // Requisição inválida.
        401 => 'UNAUTHORIZED', // Acesso negado por falta de autenticação.
        402 => 'PAYMENT_REQUIRED', // Acesso negado por falta de pagamento.
        403 => 'FORBIDDEN', // Acesso negado por falta de permissão.
        404 => 'NOT_FOUND', // Registro não encontrado.
        405 => 'METHOD_NOT_ALLOWED', // Metodo não permitido.
        406 => 'NOT_ACCEPTABLE',
        407 => 'PROXY_AUTHENTICATION_REQUIRED',
        408 => 'REQUEST_TIMEOUT', // Pedido recusado por estar expirado.
        409 => 'CONFLICT',
        410 => 'GONE',
        411 => 'LENGTH_REQUIRED',
        412 => 'PRECONDITION_FAILED', // Há condições prévias não satisfeitas.
        413 => 'PAYLOAD_TOO_LARGE',
        414 => 'URI_TOO_LARGE',
        416 => 'REQUEST_RANGE_NOT_SATISFIABLE',
        417 => 'EXPECTATION_FAILED',
        418 => 'IM_A_TEAPOT',
        420 => 'ENHACE_YOUR_CALM',
        422 => 'UNPROCESSABLE_ENTITY',
        423 => 'LOCKED',
        424 => 'FAILED_DEPENDENCY',
        425 => 'UNORDERED_COLLECTION',
        426 => 'UPGRADE_REQUIRED',
        429 => 'TOO_MANY_REQUESTS',
        431 => 'REQUEST_HEADER_FIELD_TOO_LARGE',
        444 => 'NO_RESPONSE',
        450 => 'BLOCKED_BY_WINDOWS_PARENTAL_CONTROLS',
        451 => 'UNAVAILABLE_FOR_LEGAL_REASONS',
        494 => 'REQUEST_HEADER_TOO_LARGE',
        ###
        500 => 'INTERNAL_SERVER_ERROR', // Falha inesperada ao processar a solicitação.
        501 => 'NOT_IMPLEMENTED', // Recurso não implementado.
        502 => 'BAD_GATEWAY',
        503 => 'SERVICE_UNAVAILABLE',
        504 => 'GATEWAY_TIMEOUT',
        506 => 'VARIANT_ALSO_NEGOTIATES',
        507 => 'INSUFFICIENT_STORAGE',
        508 => 'LOOP_DETECTED',
        509 => 'BANDWIDTH_LIMIT_EXCEEDED',
        510 => 'NOT_EXTENDED',
    ];

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    protected function scrudRender($request, Exception $e)
    {
        // return parent::render($request, $e);

        $response = [
            'status' => 500,
            'description' => '',
            'exception' => class_basename($e),
            'message' => '',
        ];

        if ($e instanceof AuthenticationException) {
            $response['status'] = 401;

        } else if ($e instanceof HttpException) {
            $response['status'] = $e->getStatusCode();
            if ($response['status'] == 404) {
                request()->route() ?: $response['status'] = 501;
            }

        } else {

        }

        //
        // ADD MESSAGE
        //

        if ($message = $e->getMessage())
            $response['message'] = $message;

        //
        // ADD DESCRIPTION
        //

        if (array_key_exists($response['status'], $this->descriptions))
            $response['description'] = $this->descriptions[$response['status']];

        //
        // ADD DEBUG INFORMATIONS
        //

        if (env('APP_DEBUG')) // && request()->get('debug', false)
            $response['debug'] = $this->debug($e);

        return response()->json($response)->setStatusCode($response['status']);
    }

    private function debug(Exception $e, array $debug = null)
    {
        is_null($debug) ? $debug = [] : null;

        $error = [];
        $error['exception'] = class_basename($e);
        $error['code'] = $e->getCode();
        $error['status'] = $e instanceof HttpException ? $e->getStatusCode() : null;
        $error['message'] = $e->getMessage();
        $error['headers'] = $e instanceof HttpException ? $e->getHeaders() : null;
        $error['line'] = $e->getLine();
        $error['file'] = $e->getFile();
        $error['trace'] = $e->getTrace();

        $debug[] = $error;
        $e->getPrevious() ? $this->debug($e->getPrevious(), $debug) : null;

        return $debug;
    }

}
