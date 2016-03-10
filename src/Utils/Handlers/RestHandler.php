<?php

namespace AoScrud\Utils\Handlers;

use AoScrud\Utils\Exceptions\DescriptionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Exception;

class RestHandler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    private $fixedMenssages = [
        400 => 'Requisição inválida.',
        404 => 'Item não encontrato.',
        412 => 'Todas as precondições devem ser atendiadas.',
        500 => 'Falha inesperada ao processar a solicitação.',
        501 => 'Recurso não implementado.',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $route = $request->route();
        $return = ['code' => 500, 'message' => '', 'description' => null];

        if (is_null($route)) {
            $return['code'] = 501;

        } elseif ($e instanceof HttpException) {
            $return['code'] = $e->getStatusCode();
            $return['message'] = $e->getMessage();
        }

        $return['description'] = json_decode($return['message']);
        json_last_error() == JSON_ERROR_NONE ? null : $return['description'] = null;

        if (array_key_exists($return['code'], $this->fixedMenssages)) {
            $return['message'] = $this->fixedMenssages[$return['code']];
        }

        if (env('APP_DEBUG')) {
            $return['debug'] = [
                'exception' => class_basename($e),
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'status' => $e instanceof HttpException ? $e->getStatusCode() : null,
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'headers' => $e instanceof HttpException ? $e->getHeaders() : null,
            ];
        }

        return response()->json($return)->setStatusCode($return['code']);
        return parent::render($request, $e);
    }
}
