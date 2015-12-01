<?php

namespace AoScrud\Tools\Handlers;

use AoScrud\Tools\Exceptions\MultiException;
use AoScrud\Tools\Exceptions\RestException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class BothHandler extends ExceptionHandler
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
        if ($e instanceof RestException) {
            $e = $e->getPrevious();

            $return = [
                'code' => ($e instanceof HttpException ? $e->getStatusCode() : $e->getCode()),
                'message' => class_basename($e),
                'issues' => '',
            ];

            if ($e instanceof ModelNotFoundException) {
                $return['code'] = 404;
                $return['message'] = 'not found';

            } elseif ($e instanceof MethodNotAllowedHttpException) {
                $return['code'] = 403;
                $return['message'] = $e->getMessage();

            } else {
                $name = $request->route()->getName();
                if (substr($name, 0, 4) == 'api.') {
                    $return['message'] = $e->getMessage();
                    if ($e instanceof MultiException) {
                        $return['issues'] = $e->getIssues();
                    }
                } else {
                    $return['message'] = 'não implementado';
                }
            }

            return response()->json($return)->setStatusCode($return['code']);
        }

        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        return parent::render($request, $e);
    }

}