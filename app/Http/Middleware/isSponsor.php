<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class isSponsor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $role = Cookie::get('roleUser');

        if($role == 2){
            return $next($request);
        }else {
            Cookie::queue(Cookie::make('token', null));
            Cookie::queue(Cookie::make('roleUser', null));
            return redirect('/auth/login');
        }
    }
}
