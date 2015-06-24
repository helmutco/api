<?php

namespace App\Http\Middleware;

use Closure;

class AllowOriginMiddleware
{
    public function handle($request, Closure $next)
    {
        header('Access-Control-Allow-Origin: http://helmut.dev');
	    header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT');
	    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
	    header('Access-Control-Allow-Credentials: true');

        return $next($request);
    }
}
