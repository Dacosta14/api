@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">💰 Nova Criptomoeda</h1>
        <p class="text-muted">Preencha os campos abaixo para cadastrar uma nova criptomoeda.</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('criptomoedas.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="sigla" class="form-label">Sigla</label>
                    <input type="text" class="form-control" id="sigla" name="sigla" required>
                </div>  

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>

                <div class="mb-3">
                    <label for="valor" class="form-label">Valor</label>
                    <input type="text" class="form-control" id="valor" name="valor" required>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
    </div>

    {{-- Botão para voltar à lista de criptomoedas --}}
    <div class="text-center mt-4">
        <a href="{{ route('criptomoedas.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
</div>
@endsection
