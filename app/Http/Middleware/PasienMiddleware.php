<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('pasien')->check()) {
            return redirect()->route('login');
        }
        
        return $next($request);
    }
}