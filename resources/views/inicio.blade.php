@extends('templates/main_layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">

            @if(session()->has('mensagem'))
                <div class="alert alert-success text-center p-1 fs-5 fw-bold">
                    {{session()->get('mensagem')}}
                </div>
            @endif

            <div class="row align-items-center mb-3">
                <div class="col">
                    <h4>Produtos</h4>
                </div>
                <div class="col text-end">
                    <a href="{{ route('cadastra_produto') }}" class="btn btn-primary">
                        <i class="bi bi-plus-square me-2"></i>Novo Produto
                    </a>
                </div>
            </div>

            @if(count($produtos) > 0)

                <hr>

                <!-- Styles -->
                <link rel="stylesheet" href="{{ asset('assets/styles.css') }}">

                <!-- JS -->
                <script src="{{ asset('js/script.js') }}"></script>

                <table id="tabela-produtos" class="table table-striped table-bordered" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Preço</th>
                            <th class="text-center">Qtde. Estoque</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td class="text-center">{{ $produto['text_produto_name'] }}</td>
                                <td class="text-center">{{ $produto['text_produto_descricao'] }}</td>
                                <td class="text-center">{{ $produto['number_produto_preco'] }}</td>
                                <td class="text-center">{{ $produto['number_produto_qtde'] }}</td>
                                <td class="text-center">{!! $produto['produto_acoes'] !!}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                

            @else
                <p class="text-center opacity-50 my-5">Nenhum produto encontrado.</p>
            @endif

        </div>
    </div>
</div>

@endsection