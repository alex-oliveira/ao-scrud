<?php

namespace AoScrud\Tools\Handlers;

use AoScrud\Tools\Exceptions\CheckerException;
use AoScrud\Tools\Exceptions\MultiException;
use AoScrud\Tools\Exceptions\ValidatorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
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
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        $route = $request->route();
        $return = ['code' => 500, 'message' => ''];
        $e instanceof MultiException ? $return['issues'] = $e->getIssues() : null;

        if ($e instanceof NotFoundHttpException || is_null($route)) {
            $return['code'] = 501;
            $return['message'] = 'recurso não implementado';

        } elseif ($e instanceof ValidatorException) {
            $return['code'] = 400;
            $return['message'] = 'requisição inválida';

        } elseif ($e instanceof CheckerException) {
            $return['code'] = 412;
            $return['message'] = 'operação abortada';

        } elseif ($e instanceof MethodNotAllowedHttpException) {
            $return['code'] = 403;
            $return['message'] = 'operação não permitida';

        } elseif ($e instanceof ModelNotFoundException) {
            $return['code'] = 404;
            $return['message'] = 'item não encontrado';

        } else {
            switch ($method = $route->getMethods()[0]) {
                case 'GET': $return['message'] = 'falha inesperada ao tentar realizar a consulta'; break;
                case 'POST': $return['message'] = 'falha inesperada ao tentar realizar o cadastro'; break;
                case 'PUT': $return['message'] = 'falha inesperada ao tentar realizar a atualização'; break;
                case 'DELETE': $return['message'] = 'falha inesperada ao tentar realizar a exclusão'; break;
                default: $return['message'] = 'falha inesperada ao tentar execultar a operação';
            }
        }

        if (true) {
            $return['debug'] = [
                'exception' => class_basename($e),
                'getFile' => $e->getFile(),
                'getLine' => $e->getLine(),
                'getStatusCode' => $e instanceof HttpException ? $e->getStatusCode() : null,
                'getCode' => $e->getCode(),
                'getMessage' => $e->getMessage(),
            ];
        }

        $code = $return['code'] >= 400 && $return['code'] < 600 ? $return['code'] : 500;

        return response()->json($return)->setStatusCode($code);
        return parent::render($request, $e);
    }
}
