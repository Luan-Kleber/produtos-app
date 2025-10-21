@extends('templates/main_layout')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h4>{{$title}}</h4>
            <hr>

            <form action="{{route('editar_produto_submit')}}" method="post">
                @csrf

                <input type="hidden" name="produto_id" value="{{Crypt::encrypt($produto->id)}}">

                <div class="row">
                    {{-- nome --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="text_produto_name" class="form-label">Nome</label>
                                <input type="text" name="text_produto_name" id="text_produto_name" class="form-control" placeholder="Nome do produto" required value="{{old('text_produto_name', $produto->nome)}}">
                                @error('text_produto_name')
                                    <div class="text-warning">{{$errors->get('text_produto_name')[0]}}</div>
                                @enderror
                        </div>
                    </div>

                    {{-- descrição --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="text_produto_descricao" class="form-label">Descrição</label>
                            <input type="text" name="text_produto_descricao" id="text_produto_descricao" class="form-control" placeholder="Descrição do produto" required value="{{old('text_produto_descricao', $produto->descricao)}}">
                            @error('text_produto_descricao')
                                <div class="text-warning">{{$errors->get('text_produto_descricao')[0]}}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- preço --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="number_produto_preco" class="form-label">Preço</label>
                            <input type="number" name="number_produto_preco" id="number_produto_preco" step="0.01" min="0" class="form-control" placeholder="Preço do produto" required value="{{old('number_produto_preco', $produto->preco)}}">
                            @error('number_produto_preco')
                                <div class="text-warning">{{$errors->get('number_produto_preco')[0]}}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- qtde. estoque --}}
                    <div class="col">
                        <div class="mb-3">
                            <label for="number_produto_qtde" class="form-label">Qtde. Estoque</label>
                            <input type="number" name="number_produto_qtde" id="number_produto_qtde" step="1" min="0" class="form-control" placeholder="Qtde. Estoque do produto" required value="{{old('number_produto_qtde', $produto->quantidade_estoque)}}">
                            @error('number_produto_qtde')
                                <div class="text-warning">{{$errors->get('number_produto_qtde')[0]}}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- cancel or submit --}}
                <div class="mb-3 text-center">
                    <button type="submit" class="btn btn-secondary px-5 m-1"><i class="bi bi-floppy me-2"></i>Guardar</button>
                    <a href="{{route('index')}}" class="btn btn-dark px-5 m-1"><i class="bi bi-x-circle me-2"></i>Cancelar</a>
                </div>
            </form>
            
            @if(session()->has('produto_error'))
                <div class="alert alert-danger text-center p-1">
                    {{session()->get('produto_error')}}
                </div>
            @endif

        </div>
    </div>
</div>
    
@endsection