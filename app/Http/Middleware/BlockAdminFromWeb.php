<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockAdminFromWeb
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // إذا كان المستخدم أدمن وحاول تصفح صفحات الطلاب، قم بتحويله فوراً للداشبورد
        if (auth()->check() && auth()->user()->hasRole('careerpath')) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}