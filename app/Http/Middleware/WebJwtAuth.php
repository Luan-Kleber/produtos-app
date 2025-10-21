<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class WebJwtAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Pega o token JWT salvo na sessão
        $token = $request->session()->get('jwt_token');

        if (!$token) {
            // Se não tiver token, redireciona pro login
            return redirect()->route('login');
        }

        try {
            // Tenta autenticar o usuário pelo token
            $user = JWTAuth::setToken($token)->authenticate();
            if (!$user) {
                // Token inválido, redireciona pro login
                return redirect()->route('login');
            }
        } catch (\Exception $e) {
            // Qualquer exceção (token inválido, expirado, etc) redireciona pro login
            return redirect()->route('login');
        }

        // Tudo ok, segue com a requisição
        return $next($request);
    }
}
