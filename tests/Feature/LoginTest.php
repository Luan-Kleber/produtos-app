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

        $user = User::factory()->create([
            'username' => 'usuario_teste',
            'password' => bcrypt('senha123'),
        ]);

        $response = $this->postJson('/api/login', [
            'username' => 'usuario_teste',
            'password' => 'senha123',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['token']);

        $token = $response->json('token');
        $this->assertNotEmpty($token);
    }
}