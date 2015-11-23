<?php

namespace AoScrud\Tools\Handlers;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
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

        return parent::render($request, $e);

        //        //if ($e instanceof ModelNotFoundException) {
        //        //    $e = new NotFoundHttpException($e->getMessage(), $e);
        //        //}
        //
        //        $status = HttpStatus::obj(500);
        //
        //        if ($e instanceof HttpException) {
        //
        //            if (HttpStatus::hasKey($e->getStatusCode()))
        //                $status = HttpStatus::obj($e->getStatusCode());
        //
        //        } else {
        //
        //            if (HttpStatus::hasKey($e->getCode()))
        //                $status = HttpStatus::obj($e->getCode());
        //
        //        }
        //
        //        $return = [
        //            'status' => $status->id,
        //            'error' => strtolower($status->name),
        //            'message' => $e->getMessage()
        //        ];
        //
        //        if (empty($return['message']))
        //            $return['message'] = $status->message;
        //
        //        return response()->json($return)->setStatusCode($status->id);
    }
}
