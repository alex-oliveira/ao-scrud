<?php

namespace AoScrud\Utils\Middleware;

use Closure;

class CORSMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 0 //

        return $next($request);

        // 1 //

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With');
        return $next($request);

        // 2 //

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With');

        // 3 //
        $headers = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Access-Control-Allow-Headers, Content-Type, Authorization, X-Requested-With'
        ];

        if ($request->getMethod() == 'OPTIONS')
            return \Illuminate\Support\Facades\Response::make('OK', 200, $headers);

        $response = $next($request);
        foreach ($headers as $key => $value)
            $response->header($key, $value);

        return $response;
    }

}