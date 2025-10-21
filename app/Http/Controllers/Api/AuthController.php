<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Faz o login via JWT
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais invalidas'], 401);
        }

        return response()->json([
            'token' => $token
        ]);
    }

    /**
     * Logout invalidando o token JWT
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Logout com sucesso']);
    }

}
