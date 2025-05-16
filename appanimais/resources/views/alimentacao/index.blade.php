@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Lista de alimentacao</h1>
        <p class="text-muted">Veja abaixo os alimentacao disponíveis.</p>
    </div>

    <!-- Botão para Adicionar Novo alimentacao -->
    <div class="text-center mb-4">
        <a href="{{ route('alimentacao.create') }}" class="btn btn-success btn-lg">Adicionar Novo alimentacao</a>
    </div>

    <div class="row">
        @foreach($alimentacao as $alimentacao)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">alimentacao #{{ $alimentacao['numero'] }}</h5>
                    <p class="card-text">
                        Tipo: {{ $alimentacao['tipo'] }}<br>
                        Preço: R$ {{ number_format($alimentacao['preco_diaria'], 2, ',', '.') }} / noite
                    </p>
                    <a href="{{ route('alimentacao.edit', $alimentacao['id']) }}" class="btn btn-primary btn-sm">Editar</a>

                    <!-- Formulário de Exclusão com Confirmação -->
                    <form action="{{ route('alimentacao.destroy', $alimentacao['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este alimentacao?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
