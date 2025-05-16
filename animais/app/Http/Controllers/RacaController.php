<?php

namespace App\Http\Controllers;

use App\Models\raca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RacaController extends Controller
{
    /**
     * Exibir todas as raças.
     */
    public function index()
    {
        $registros = raca::all();

        return response()->json([
            'success' => true,
            'data' => $registros
        ], 200);
    }

    /**
     * Cadastrar nova raça.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Nome_da_raca' => 'required',
            'Tamanho' => 'required',
            'idade' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registro = raca::create($request->all());

        if ($registro) {
            return response()->json([
                'success' => true,
                'message' => 'Raça cadastrada com sucesso!',
                'data' => $registro
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao cadastrar a raça.'
        ], 500);
    }

    /**
     * Exibir raça específica.
     */
    public function show($id)
    {
        $registro = raca::find($id);

        if ($registro) {
            return response()->json([
                'success' => true,
                'data' => $registro
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Raça não localizada.'
        ], 404);
    }

    /**
     * Atualizar raça.
     */
    public function update(Request $request, $id)
    {
        $registro = raca::find($id);

        if (!$registro) {
            return response()->json([
                'success' => false,
                'message' => 'Raça não encontrada.'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'Nome_da_raca' => 'required',
            'Tamanho' => 'required',
            'idade' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Registros inválidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registro->Nome_da_raca = $request->Nome_da_raca;
        $registro->Tamanho = $request->Tamanho;
        $registro->idade = $request->idade;

        if ($registro->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Raça atualizada com sucesso!',
                'data' => $registro
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar a raça.'
        ], 500);
    }

    /**
     * Remover raça.
     */
    public function destroy($id)
    {
        $registro = raca::find($id);

        if (!$registro) {
            return response()->json([
                'success' => false,
                'message' => 'Raça não encontrada.'
            ], 404);
        }

        if ($registro->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Raça deletada com sucesso.'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a raça.'
        ], 500);
    }
}
