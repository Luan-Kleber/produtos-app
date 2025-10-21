<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_gera_token()
    {
        // Cria usuário fake
        $user = User::factory()->create([
            'username' => 'usuario_teste',
            'password' => bcrypt('senha123'), // senha hash para autenticar
        ]);

        // Faz POST para login com username e password
        $response = $this->postJson('/api/login', [
            'username' => 'usuario_teste',
            'password' => 'senha123',
        ]);

        // Verifica se retornou status 200 e tem token na resposta
        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);

        $token = $response->json('token');
        $this->assertNotEmpty($token);
    }
}