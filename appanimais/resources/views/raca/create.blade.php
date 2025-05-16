@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>adicionar raça</h2>
    <form action="{{ route('raca.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="numero" class="form-label">Nome da raça</label>
            <input type="text" class="form-control" id="Nome_da_raca" name="Nome_da_raca" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tamanho</label>
            <input type="text" class="form-control" id="Tamanho" name="Tamanho" required>
        </div>
        <div class="mb-3">
            <label for="preco_diaria" class="form-label">Idade</label>
            <input type="number" class="form-control" id="idade" name="idade" required>
        </div>
        <button type="submit" class="btn btn-primary">adicionar raça</button>
    </form>
</div>
@endsection
