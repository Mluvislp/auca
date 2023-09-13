<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {

        header('Access-Control-Allow-Origin:  *');
        header('Access-Control-Allow-Headers:  *');
        header('Access-Control-Allow-Methods:  *');
        if($request->getMethod() == "OPTIONS") {
            return Response::make('OK', 200, $headers);
        }
        return $next($request);
        //file config middleware back-end để font-end có thể truy cập tới api dưới local

    }
}
