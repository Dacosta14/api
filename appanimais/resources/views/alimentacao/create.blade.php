@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Lista de alimentacao</h1>
        <p class="text-muted">Veja abaixo as alimentacao feitas.</p>
    </div>

    <!-- Exibir mensagens de sucesso ou erro -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botão para Adicionar Nova Reserva -->
    <div class="text-center mb-4">
        <a href="{{ route('alimentacao.create') }}" class="btn btn-success btn-lg">Adicionar Nova alimentacao</a>
    </div>

    <!-- Verifica se há reservas -->
    @if(count($alimentacao) > 0)
        <div class="row">
            @foreach($alimentacao as $alimentacao)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">Hospede: {{ $alimentacao['nome_hospede'] }}</h5>
                            <p class="card-text">
                                Check-in: {{ \Carbon\Carbon::parse($alimentacao['data_checkin'])->format('d/m/Y') }}<br>
                                Check-out: {{ \Carbon\Carbon::parse($alimentacao['data_checkout'])->format('d/m/Y') }}<br>
                            </p>
                            <a href="{{ route('alimentacao.edit', $alimentacao['id']) }}" class="btn btn-primary btn-sm">Editar</a>

                            <!-- Botão de Excluir com Confirmação -->
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $alimentacao['id'] }}">Excluir</button>
                            
                            <!-- Modal de Confirmação de Exclusão -->
                            <div class="modal fade" id="deleteModal{{ $alimentacao['id'] }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Você tem certeza de que deseja excluir esta alimentacao?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('alimentacao.destroy', $alimentacao['id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Confirmar Exclusão</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">Não há alimentacao cadastradas.</p>
    @endif
</div>
@endsection
