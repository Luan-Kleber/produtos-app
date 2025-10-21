<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;

use Illuminate\Validation\Rule;


class ProdutoController extends Controller
{
    public function getAll()
    {
        return Produto::select('nome', 'descricao', 'preco', 'quantidade_estoque')->paginate(10);
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                Rule::unique('produtos', 'nome'),
            ],
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0',
        ]);

        $produto = Produto::create($validated);

        return response()->json([
            'message' => 'Produto criado',
            'data' => [
                'nome' => $produto->nome,
                'descricao' => $produto->descricao,
                'preco' => $produto->preco,
                'quantidade_estoque' => $produto->quantidade_estoque,
                'created_at' => $produto->created_at,
            ]
        ], 201);
    }

    public function get($id)
    {
        $produto = Produto::where('nome', 'ilike', $id)
        ->select('nome', 'descricao', 'preco', 'quantidade_estoque')
        ->first();

        if (!$produto) {
            return response()->json(['error' => "Produto '$id' não encontrado"], 404);
        }

        return $produto;
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::where('nome', 'ilike', $id)
        ->select('nome', 'descricao', 'preco', 'quantidade_estoque')
        ->first();

        if (!$produto) {
            return response()->json(['error' => "Produto '$id' não encontrado"], 404);
        }

        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                Rule::unique('produtos', 'nome')->ignore($produto->id),
            ],
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0',
        ]);

        $produto->update($validated);

        return response()->json([
            'message' => 'Produto atualizado',
            'data' => [
                'nome' => $produto->nome,
                'descricao' => $produto->descricao,
                'preco' => $produto->preco,
                'quantidade_estoque' => $produto->quantidade_estoque,
                'updated_at' => $produto->updated_at,
            ]
        ]);
    }

    public function destroy($id)
    {
        $produto = Produto::where('nome', 'ilike', $id)->first();

        if (!$produto) {
            return response()->json(['error' => "Produto '$id' não encontrado"], 404);
        }

        $produto->delete();

        return response()->json(['message' => 'Produto deletado com sucesso']);
    }
}
