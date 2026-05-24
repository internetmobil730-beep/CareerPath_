<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // التحقق الصارم: يجب أن يكون مسجلاً، وإما إيميله هو إيميلك أو يمتلك صلاحية careerpath
        if (auth()->check() && (auth()->user()->email === 'internetmobil730@gmail.com' || auth()->user()->hasRole('careerpath'))) {
            return $next($request);
        }

        // إذا كان طالباً عادياً يحاول التسلل، يتم طرده فوراً بـ 403
        abort(403, 'Sistem yöneticisi yetkileriniz yok');
    }
}