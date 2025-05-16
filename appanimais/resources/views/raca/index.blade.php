@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Lista de Raças</h1>
        <p class="text-muted">Veja abaixo as raças cadastradas.</p>
    </div>

    <!-- Botão para Adicionar Nova Raça -->
    <div class="text-center mb-4">
        <a href="{{ route('raca.create') }}" class="btn btn-success btn-lg">Adicionar Nova Raça</a>
    </div>

    <div class="row">
        @forelse($racas as $raca)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Raça: {{ $raca['nome'] ?? 'Sem nome' }}</h5>
                        <p class="card-text">
                            Descrição: {{ $raca['descricao'] ?? 'Sem descrição' }}<br>
                            ID: {{ $raca['id'] ?? 'Sem ID' }}
                        </p>
                        <a href="{{ route('raca.edit', $raca['id']) }}" class="btn btn-primary btn-sm">Editar</a>

                        <form action="{{ route('raca.destroy', $raca['id']) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta raça?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Nenhuma raça cadastrada ainda.</p>
        @endforelse
    </div>
</div>
@endsection
