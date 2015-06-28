<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
		$domain = $request->header('Origin');

	    switch ($domain) {
	    	case 'http://helmut.dev':
	    		$response->header('Access-Control-Allow-Origin', 'http://helmut.dev');
	    		break;

	    	case 'http://alphaone.helmut.co':
	    		$response->header('Access-Control-Allow-Origin', 'http://alphaone.helmut.co');
	    		break;

	    	case 'http://helmut.co':
	    		$response->header('Access-Control-Allow-Origin', 'http://helmut.co');
	    		break;
	    	
	    	default:
	    		break;
	    }
	    $response->header('Access-Control-Allow-Credentials', 'true');
	    $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE');
	    $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
	    return $response;
    }
}
