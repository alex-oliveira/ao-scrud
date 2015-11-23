<?php

namespace AoScrud\Middleware;

use Closure;

class SearchLimitMaxMiddleware
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
        if ($request->has('limit')) {
            $limit = $request->get('limit');
            if (!(is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= 50)) {
                $request->replace(['limit' => null]);
            }
        }

        return $next($request);
    }

}
