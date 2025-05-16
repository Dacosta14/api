<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RacaController extends Controller
{
    // URL base da API de quartos
    private $urlApi = 'http://127.0.0.1:8000/api/alimentacao';

    /**
     * Listar todos os quartos (API externa).
     */
    public function index()
    {
        $response = Http::get($this->urlApi);
        $data = $response->json();

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar os quartos.'
            ], 500);
        }

        if (empty($data['data'])) {
            return response()->json([
                'success' => false,
                'message' => 'Nenhum quarto encontrado.'
            ], 404);
        }

            // Passando os dados para a view
            return view('alimentacao.index', [
                'alimentacao' => $data['data'] ?? [],
                'message' => $data['message'] ?? ''
            ]);
        
        return response()->json([
            'success' => true,
            'message' => $data['message'] ?? 'Quartos carregados com sucesso!',
            'data' => $data['data'],
            'total' => count($data['data'])
        ], 200);
    }

    /**
     * Criar um novo quarto (POST para API externa).
     */
    public function store(Request $request)
    {
        // Validar os dados conforme seu modelo
        $validator = Validator::make($request->all(), [
            'quantiadade' => 'required',
            'horario_alimentacao' => 'required',
            'tipo_racao' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar quarto',
                'data' => $validator->errors()
            ], 400);
        }

        $response = Http::post($this->urlApi, $request->only('quantiadade', 'horario_alimentacao', 'tipo_racao'));

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'aliemnto cadastrado com sucesso!',
                'data' => $response->json()
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar alimento.'
            ], 500);
        }
    }

    /**
     * Mostrar um quarto específico (GET da API externa).
     */
    public function show($id)
    {
        $response = Http::get("$this->urlApi/$id");
        $data = $response->json();

        if (!$response->successful() || empty($data['data'])) {
            return response()->json([
                'success' => false,
                'message' => 'alimento não encontrado.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'alimento encontrado com sucesso!',
            'data' => $data['data']
        ], 200);
    }

    /**
     * Atualizar um quarto (PUT na API externa).
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantiadade' => 'required',
            'horario_alimentacao' => 'required',
            'tipo_racao' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar quarto',
                'data' => $validator->errors()
            ], 400);
        }

        $response = Http::put("$this->urlApi/$id", $request->only('quantiadade', 'horario_alimentacao', 'tipo_racao'));

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'alimento atualizado com sucesso!',
                'data' => $response->json()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar quarto.'
            ], 500);
        }
    }

    /**
     * Deletar um quarto (DELETE na API externa).
     */
    public function destroy($id)
    {
        $response = Http::delete("$this->urlApi/$id");

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'Quarto excluído com sucesso!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir quarto.'
            ], 500);
        }
    }

    /**
     * Listar quartos com paginação.
     */
    public function listar(Request $request)
    {
        $response = Http::get($this->urlApi, [
            'page' => $request->input('page', 1)
        ]);

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar os quartos.'
            ], 500);
        }

        return response()->json($response->json());
    }
}
