<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Produto;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    protected function authenticate()
    {
        $user = User::factory()->create();
        $token = auth()->login($user);
        return "Bearer $token";
    }

    public function test_usuario_autenticado_consegue_listar_produtos()
    {
        $authHeader = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => $authHeader,
            'Accept' => 'application/json'
        ])->get('/api/produtos');

        $response->assertStatus(200);
    }

    public function test_usuario_autenticado_consegue_cadastrar_produto()
    {
        $authHeader = $this->authenticate();

        $produtoData = [
            'nome' => 'Produto Teste',
            'descricao' => 'Descrição de teste',
            'preco' => 100.50,
            'quantidade_estoque' => 20
        ];

        $response = $this->withHeaders([
            'Authorization' => $authHeader,
            'Accept' => 'application/json'
        ])->post('/api/produtos', $produtoData);

        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Produto Teste']);
    }

    public function test_usuario_autenticado_consegue_editar_produto()
    {
        $authHeader = $this->authenticate();

        $produto = Produto::factory()->create();

        $dadosAtualizados = [
            'nome' => 'Nome Atualizado',
            'descricao' => 'Descrição atualizada',
            'preco' => 200.00,
            'quantidade_estoque' => 30
        ];

        $response = $this->withHeaders([
            'Authorization' => $authHeader,
            'Accept' => 'application/json'
        ])->put("/api/produtos/{$produto->nome}", $dadosAtualizados);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'Nome Atualizado']);
    }

    public function test_usuario_autenticado_consegue_deletar_produto()
    {
        $authHeader = $this->authenticate();

        $produto = Produto::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => $authHeader,
            'Accept' => 'application/json'
        ])->delete("/api/produtos/{$produto->nome}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['message' => 'Produto deletado com sucesso']);
    }
}
