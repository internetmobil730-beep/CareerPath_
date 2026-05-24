<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->email === 'internetmobil730@gmail.com') {
            return $next($request);
        }

        abort(403, 'Sistem yöneticisi yetkileriniz yok');
    }
}