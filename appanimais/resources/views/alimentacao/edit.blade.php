@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Editar alimentacao</h2>
    <form action="{{ route('alimentacao.update', $alimentacao['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="quantiadade" class="form-label">Número do Quarto</label>
            <input type="text" class="form-control" id="quantiadade" name="quantiadade" value="{{ $alimentacao['quantiadade'] }}" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo_racao" name="tipo_racao" value="{{ $alimentacao['tipo_racao'] }}" required>
        </div>
        <div class="mb-3">
            <label for="horario_alimentacao" class="form-label">Preço da Diária</label>
            <input type="number" class="form-control" id="horario_alimentacao" name="horario_alimentacao" value="{{ $alimentacao['horario_alimentacao'] }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar alimentacao</button>
    </form>
</div>
@endsection
