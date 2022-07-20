<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $trusted_domains = ["http://127.0.0.1:9004", "http://localhost:9003"];
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: ACCEPT, CONTENT-TYPE, X-CSRF-TOKEN");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");
        $headers = [
        'Access-Control-Allow-Methods'=> 'POST, GET, OPTIONS, PUT, DELETE',
        'Access-Control-Allow-Credentials' => true,
        'Access-Control-Allow-Headers'=> 'Access-Control-Allow-Origin, Origin, X-XSRF-TOKEN, Content-Type, X-Auth-Token, Authorization, X-Requested-With'
        ];
        if($request->getMethod() == "OPTIONS") {

            return response()->make('OK', 200, $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value)
        $response->header($key, $value);
        return $response;
    }
}
