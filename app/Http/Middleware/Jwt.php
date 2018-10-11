<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 11/10/2018
 * Time: 01:13
 */

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;


class Jwt
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
        JWTAuth::parseToken()->authenticate();
        return $next($request);
    }

}