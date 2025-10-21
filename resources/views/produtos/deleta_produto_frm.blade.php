@extends('templates/main_layout')

@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <h4>{{$title}}</h4>
            <hr>

            <form action="{{route('delete_produto_submit')}}" method="post">
                @csrf

                <input type="hidden" name="produto_id" value="{{Crypt::encrypt($produto->id)}}">

                <div class="alert alert-dark" role="alert">
                    <h4 class="alert-heading">Deletar Produto?</h4>
                    <hr>
                    <p>Tem certeza que deseja excluir o produto <strong>{{ $produto->nome }} ?</strong></p>
                    
                    {{-- cancel or submit --}}
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-danger px-5 m-1"><i class="bi bi-x-circle me-2"></i>Sim</button>
                        <a href="{{route('index')}}" class="btn btn-light px-5 m-1"><i class="bi bi-arrow-left me-2"></i>Não</a>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
    
@endsection