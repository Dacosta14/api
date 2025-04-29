<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CriptomoedaController extends Controller
{
    private $urlApi = 'http://127.0.0.1:8000/api/cripto';

    // Método para exibir a lista de criptomoedas
    public function index()
    {
        // Requisição GET à API para pegar todas as criptomoedas
        $response = Http::get($this->urlApi);
        $data = $response->json();

        // Verificando se a resposta foi bem-sucedida
        if (!$response->successful()) {
            return view('criptomoedas.index', [
                'message' => 'Erro ao carregar as criptomoedas.'
            ]);
        }

        // Passando os dados para a view
        return view('criptomoedas.index', [
            'criptos' => $data['data'] ?? [],
            'message' => $data['message'] ?? ''
        ]);
    }

    // Método para armazenar uma nova criptomoeda
    public function store(Request $request)
    {
        // Enviando dados via POST para a API
        $response = Http::post($this->urlApi, $request->only('sigla', 'nome', 'valor'));

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return redirect()->route('criptomoedas.index');
        } else {
            return redirect()->route('criptomoedas.create')->with('error', 'Erro ao cadastrar a criptomoeda.');
        }
    }

    // Método para exibir o formulário de criação
    public function create()
    {
        return view('criptomoedas.create');
    }

    // Método para exibir o formulário de edição
    public function edit($id)
    {
        // Requisição GET à API para pegar a criptomoeda por ID
        $response = Http::get("$this->urlApi/$id");
        $cripto = $response->json()['data'] ?? null;

        // Verificando se a criptomoeda foi encontrada
        if (!$cripto) {
            return redirect()->route('criptomoedas.index')->with('error', 'Criptomoeda não encontrada.');
        }

        // Passando a criptomoeda para a view de edição
        return view('criptomoedas.edit', compact('cripto'));
    }

    // Método para atualizar uma criptomoeda
    public function update(Request $request, $id)
    {
        // Enviando dados via PUT para a API
        $response = Http::put("$this->urlApi/$id", $request->only('sigla', 'nome', 'valor'));

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return redirect()->route('criptomoedas.index');
        } else {
            return redirect()->route('criptomoedas.edit', $id)->with('error', 'Erro ao atualizar a criptomoeda.');
        }
    }

    // Método para excluir uma criptomoeda
    public function destroy($id)
    {
        // Enviando requisição DELETE para a API
        $response = Http::delete("$this->urlApi/$id");

        // Verificando se a requisição foi bem-sucedida
        if ($response->successful()) {
            return redirect()->route('criptomoedas.index');
        } else {
            return redirect()->route('criptomoedas.index')->with('error', 'Erro ao excluir a criptomoeda.');
        }
    }

    // Método para listar criptomoedas com paginação
    public function listar(Request $request)
    {
        // Requisição GET para a API com paginação
        $response = Http::get($this->urlApi, [
            'page' => $request->input('page', 1) // Pega o número da página da requisição
        ]);

        // Se a resposta da API falhar, retorna um erro
        if (!$response->successful()) {
            return response()->json(['message' => 'Erro ao carregar as criptomoedas.'], 500);
        }

        // Retorna as criptomoedas com paginação no formato JSON
        return response()->json($response->json());
    }
}
