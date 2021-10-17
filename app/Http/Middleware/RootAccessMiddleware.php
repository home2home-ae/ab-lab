<?php

namespace App\Http\Middleware;

use App\Data\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RootAccessMiddleware
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
        if (Auth::user()->user_type !== UserType::ROOT) {
            return redirect()->home()->with('message', 'Forbidden, restricted route!');
        }
        return $next($request);
    }
}
