@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">💰 Lista de Criptomoedas</h1>
        <p class="text-muted">Veja abaixo as principais moedas cadastradas</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if(count($criptos))
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Sigla</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criptos as $cripto)
                            <tr>
                                <td class="fw-bold">{{ $cripto['sigla'] }}</td>
                                <td>{{ $cripto['nome'] }}</td>
                                <td class="text-success fw-semibold">R$ {{ number_format($cripto['valor'], 2, ',', '.') }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary me-1">Editar</a>
                                    <a href="#" class="btn btn-sm btn-outline-danger">Excluir</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted fs-5">🚫 Nenhuma criptomoeda encontrada.</p>
            @endif
        </div>
    </div>

    {{-- Botão para cadastrar uma nova criptomoeda --}}
    <div class="text-center mt-4">
        <a href="{{ route('criptomoedas.create') }}" class="btn btn-success btn-lg">Cadastrar Criptomoeda</a>
    </div>
</div>
@endsection
