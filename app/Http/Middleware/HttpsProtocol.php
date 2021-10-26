<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HttpsProtocol
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_SECURE') && !$request->secure() && App::environment() === 'production') {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }
}
