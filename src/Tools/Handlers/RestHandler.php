<?php

namespace AoScrud\Tools\Handlers;

use AoScrud\Tools\Exceptions\MultiException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        $return = [];
        $return['code'] = $e instanceof HttpException ? $e->getStatusCode() : $e->getCode();
        if ($e instanceof MethodNotAllowedHttpException) {
            $return['message'] = 'Metodo não permitido';
        } else {
            $return['message'] = $e->getMessage();
        }

        empty($return['message']) ? $return['message'] = class_basename($e) : null;

        if ($e instanceof MultiException) {
            $return['issues'] = $e->getIssues();
        }

        if ($e instanceof MultiException) {
            $e = new \Exception(json_encode($e->getIssues()), $e->getCode(), $e);
        }

        //return response()->json($return)->setStatusCode($return['code']);
        return parent::render($request, $e);
    }
}
