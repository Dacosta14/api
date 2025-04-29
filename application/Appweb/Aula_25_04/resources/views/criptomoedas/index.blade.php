@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">💰 Lista de Criptomoedas</h1>
        <p class="text-muted">Veja abaixo as principais moedas cadastradas</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="cripto-table-container">
                <p class="text-center text-muted fs-5">🔄 Carregando criptomoedas...</p>
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button id="prevPage" class="btn btn-outline-secondary" disabled>⬅ Anterior</button>
                <button id="nextPage" class="btn btn-outline-secondary" disabled>Próxima ➡</button>
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('criptomoedas.create') }}" class="btn btn-success btn-lg">Cadastrar Criptomoeda</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentPage = 1; // Inicializando a página com 1.

    // Função que carrega os dados das criptomoedas
    function loadCriptos(page = 1) {
        fetch(`/criptomoedas/ajax/listar?page=${page}`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('cripto-table-container');

                // Verificando se há dados
                if (!data.data || data.data.length === 0) {
                    container.innerHTML = `<p class="text-center text-muted fs-5">🚫 Nenhuma criptomoeda encontrada.</p>`;
                    document.getElementById('prevPage').disabled = true;
                    document.getElementById('nextPage').disabled = true;
                    return;
                }

                // Gerando a tabela
                let html = `
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sigla</th>
                                    <th>Nome</th>
                                    <th>Valor</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                `;

                // Preenchendo a tabela com os dados
                data.data.forEach(cripto => {
                    let valorLimpo = cripto.valor.replace(/[^0-9,\.]/g, '');
                    let valorFloat = parseFloat(valorLimpo.replace(',', '.')) || 0;
                    let valorFormatado = valorFloat.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

                    html += `
                        <tr>
                            <td class="fw-bold">${cripto.sigla}</td>
                            <td>${cripto.nome}</td>
                            <td class="text-success fw-semibold">${valorFormatado}</td>
                            <td>
                                <a href="/criptomoedas/${cripto.id}/edit" class="btn btn-sm btn-outline-primary me-1">Editar</a>
                                <form action="/criptomoedas/${cripto.id}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta criptomoeda?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    `;
                });

                html += '</tbody></table></div>';
                container.innerHTML = html;

                // Atualiza o estado dos botões
                currentPage = data.current_page;
                document.getElementById('prevPage').disabled = !data.prev_page_url;
                document.getElementById('nextPage').disabled = !data.next_page_url;
            })
            .catch(() => {
                document.getElementById('cripto-table-container').innerHTML = `
                    <p class="text-danger text-center">❌ Erro ao carregar os dados.</p>
                `;
            });
    }

    // Carregar criptomoedas quando a página for carregada
    document.addEventListener('DOMContentLoaded', () => loadCriptos());

    // Navegação para a página anterior
    document.getElementById('prevPage').addEventListener('click', () => {
        if (currentPage > 1) loadCriptos(currentPage - 1);
    });

    // Navegação para a próxima página
    document.getElementById('nextPage').addEventListener('click', () => {
        loadCriptos(currentPage + 1);
    });
</script>
@endpush
