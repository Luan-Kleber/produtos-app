<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function index()
    {
        return redirect()->route('inicio');
    }

    public function login()
    {
        $data = [
            'title' => 'Login'
        ];

        return view('login_frm', $data);
    }

    /**
     * Faz o login via JWT
     */
    public function login_submit(Request $request)
    {
        $request->validate([
            'text_username' => 'required|min:3',
            'text_password' => 'required|min:3',
        ], [
            'text_username.required' => 'O campo é de preenchimento obrigatório.',
            'text_username.min' => 'O campo deve ter no mínimo 3 caracteres.',
            'text_password.required' => 'O campo é de preenchimento obrigatório.',
            'text_password.min' => 'O campo deve ter no mínimo 3 caracteres.',
        ]);

        $credentials = [
            'username' => $request->input('text_username'),
            'password' => $request->input('text_password')
        ];

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return redirect()->route('login')->withInput()->with('login_error', 'Login inválido');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->withInput()->with('login_error', 'Erro no servidor');
        }

        $request->session()->put('jwt_token', $token);

        $request->session()->put('username', $credentials['username']);

        return redirect()->route('index');
    }

    /**
     * Logout invalidando o token JWT
     */
    public function logout(Request $request)
    {
        $token = $request->session()->get('jwt_token');

        if ($token) {
            try {
                JWTAuth::invalidate($token);
            } catch (\Exception $e) {
                // pode logar o erro, mas não impede o logout
            }
        }

        $request->session()->forget(['jwt_token', 'username']);

        return redirect()->route('login');
    }
}
