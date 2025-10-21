<?php

namespace App\Http\Controllers\Web;

use App\Models\Produto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function inicio()
    {
        $data = [
            'title' => 'Gestão de Produtos',
            'produtos' => $this->_get_produtos()
        ];

        return view('inicio', $data);
    }

    /**
     * Inserir
    */
    public function cadastra_produto()
    {
        $data = [
            'title' => 'Cadastro Produto'
        ];

        return view('produtos.cadastra_produto_frm', $data);
    }

    public function cadastra_produto_submit(Request $request)
    {
        // form validation
        $request->validate([
            'text_produto_name'         => 'required|min:4|max:200',
            'text_produto_descricao'    => 'min:4|max:200',
            'number_produto_preco'      => 'required|numeric|min:0|max:999999.99',
            'number_produto_qtde'       => 'required|numeric|min:0|max:999999',
        ], [
            'text_produto_name.required' => 'O campo é de preenchimento obrigatório.',
            'text_produto_name.min' => 'O campo deve ter no mínimo :min caracteres.',
            'text_produto_name.max' => 'O campo deve ter no máximo :max caracteres.',

            'text_produto_descricao.min' => 'O campo deve ter no mínimo :min caracteres.',
            'text_produto_descricao.max' => 'O campo deve ter no máximo :max caracteres.',

            'number_produto_preco.required' => 'O campo é de preenchimento obrigatório.',
            'number_produto_preco.min' => 'O campo deve ter no mínimo :min caracteres.',
            'number_produto_preco.numeric' => 'O campo deve conter um valor numérico.',

            'number_produto_qtde.required' => 'O campo é de preenchimento obrigatório.',
            'number_produto_qtde.min' => 'O campo deve ter no mínimo :min caracteres.',
            'number_produto_qtde.numeric' => 'O campo deve conter um valor numérico.',
        ]);

        $model = new Produto();

        $produto = $model->whereRaw('LOWER(nome) = ?', [strtolower($request->input('text_produto_name'))])
                 ->first();


        // verifica se produto existe
        if($produto) {
            return redirect()->route('cadastra_produto')->with('produto_error', 'Já existe um produto com o mesmo nome.');
        }
        
        //insert
        $model->nome = $request->input('text_produto_name');
        $model->descricao = $request->input('text_produto_descricao');
        $model->preco = $request->input('number_produto_preco');
        $model->quantidade_estoque = $request->input('number_produto_qtde');
        $model->created_at = date('Y-m-d H:s:i');
        $model->save();

        return redirect()->route('inicio')->with('mensagem', 'Produto cadastrado com sucesso!');
    }

    /**
     * Editar
    */
    public function editar_produto($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->route('inicio');
        }

        $model = new Produto();
        $produto = $model->where('id', '=', $id)
                ->first();

        // verifica se produto existe
        if(!$produto) {
            return redirect()->route('inicio');
        }

        $data = [
            'title' => 'Editar Produto',
            'produto' => $produto
        ];

        return view('produtos.edita_produto_frm', $data);
    }

    public function editar_produto_submit(Request $request)
    {
        // form validation
        $request->validate([
            'text_produto_name'         => 'required|min:4|max:200',
            'text_produto_descricao'    => 'min:4|max:20',
            'number_produto_preco'      => 'required|numeric|min:0|max:999999.99',
            'number_produto_qtde'       => 'required|numeric|min:0|max:999999',
        ], [
            'text_produto_name.required' => 'O campo é de preenchimento obrigatório.',
            'text_produto_name.min' => 'O campo deve ter no mínimo :min caracteres.',
            'text_produto_name.max' => 'O campo deve ter no máximo :max caracteres.',

            'text_produto_descricao.min' => 'O campo deve ter no mínimo :min caracteres.',
            'text_produto_descricao.max' => 'O campo deve ter no máximo :max caracteres.',

            'number_produto_preco.required' => 'O campo é de preenchimento obrigatório.',
            'number_produto_preco.min' => 'O campo deve ter no mínimo :min caracteres.',
            'number_produto_preco.numeric' => 'O campo deve conter um valor numérico.',

            'number_produto_qtde.required' => 'O campo é de preenchimento obrigatório.',
            'number_produto_qtde.min' => 'O campo deve ter no mínimo :min caracteres.',
            'number_produto_qtde.numeric' => 'O campo deve conter um valor numérico.',
        ]);

        $produto = Crypt::decrypt($request->input('produto_id'));

        $model = new Produto();

        $model->whereRaw('id = ?', [$produto])
                 ->first();
        
        if ($model) {
            $model->nome = $request->input('text_produto_name');
            $model->descricao = $request->input('text_produto_descricao');
            $model->preco = $request->input('number_produto_preco');
            $model->quantidade_estoque = $request->input('number_produto_qtde');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
        } else {
            return redirect()->route('editar_produto', ['id' => Crypt::encrypt($produto)])->with('produto_error', 'Erro ao editar produto.');
        }

        return redirect()->route('inicio')->with('mensagem', 'Produto atualizado com sucesso!');

    }

    /**
     * Excluir 
    */
    public function delete_produto($id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->route('inicio');
        }

        $model = new Produto();
        $produto = $model->where('id', '=', $id)
                ->first();

        // verifica se produto existe
        if(!$produto) {
            return redirect()->route('inicio');
        }

        $data = [
            'title' => 'Exluir Produto',
            'produto' => $produto
        ];

        return view('produtos.deleta_produto_frm', $data);
    }

    public function delete_produto_submit(Request $request)
    {
        try {
            $id = Crypt::decrypt($request->input('produto_id'));
        } catch (\Exception $e) {
            return redirect()->route('inicio');
        }

        Produto::where('id', $id)->delete();

        return redirect()->route('inicio')->with('mensagem', 'Produto deletado com sucesso!');
    }

    /**
     * métodos privados
    */
    private function _get_produtos()
    {
        $model = new Produto();

        $produtos = $model->get();

        $collection = [];

        foreach($produtos as $produto) {

            $link_edit = '<a href="'.route('editar_produto', ['id' => Crypt::encrypt($produto->id)]).'" class="btn btn-secondary me-2"><i class="bi bi-pencil-square"></i></a>';
            $link_delete = '<a href="'.route('delete_produto', ['id' => Crypt::encrypt($produto->id)]).'" class="btn btn-danger"><i class="bi bi-trash"></i></a>';

            $collection[] = [
                'text_produto_name' => $produto->nome,
                'text_produto_descricao' => $produto->descricao,
                'number_produto_preco' => $produto->preco,
                'number_produto_qtde' => $produto->quantidade_estoque,
                'produto_acoes' => $link_edit . $link_delete
            ];

        }

        return $collection;
    }
}