@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar Quarto</h2>
   <form action="{{ route('raca.update', $raca['id'] ?? '') }}" method="POST">

        @csrf
        @method('PUT')
    <div class="mb-3">
            <label for="numero" class="form-label">Nome da raça</label>
            <input type="text" class="form-control" id="numero" name="numero" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tamanho</label>
            <input type="text" class="form-control" id="tipo" name="tipo" required>
        </div>
        <div class="mb-3">
            <label for="preco_diaria" class="form-label">Idade</label>
            <input type="number" class="form-control" id="preco_diaria" name="preco_diaria" required>
        </div>
        <button type="submit" class="btn btn-primary">atualizar raça</button>
    </form>
</div>
@endsection

