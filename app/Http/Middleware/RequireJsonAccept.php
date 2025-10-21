<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireJsonAccept
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->expectsJson()) {
            return response()->json([
                'error' => 'O header Accept: application/json é obrigatório para acessar esta API.'
            ], 406); // 406 Not Acceptable
        }

        return $next($request);
    }
}

