<?php

namespace App\Http\Controllers;

use App\Models\alimentacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = alimentacao::all();
        $contador = $registros->count();

        if ($contador > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Alimentações encontradas com sucesso!',
                'data' => $registros,
                'total' => $contador
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Nenhuma alimentação encontrada'
            ], 404);  
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantiadade' => 'required',
            'horario_alimentacao' => 'required',
            'tipo_racao' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar alimentação',
                'data' => $validator->errors()
            ], 400);
        }

        $registro = alimentacao::create($request->all());

        if ($registro) {
            return response()->json([
                'success' => true,
                'message' => 'Alimentação cadastrada com sucesso!',
                'data' => $registro
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar alimentação'
            ], 500);
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $registro = alimentacao::find($id);

        if ($registro) {
            return response()->json([
                'success' => true,
                'message' => 'Alimentação encontrada com sucesso!',
                'data' => $registro
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Alimentação não encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
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
                'message' => 'Erro ao atualizar alimentação',
                'data' => $validator->errors()
            ], 400);
        }

        $registroBanco = alimentacao::find($id);

        if (!$registroBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Alimentação não encontrada'
            ], 404);
        }

        $registroBanco->quantiadade = $request->quantiadade;
        $registroBanco->horario_alimentacao = $request->horario_alimentacao;
        $registroBanco->tipo_racao = $request->tipo_racao;

        if ($registroBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Alimentação atualizada com sucesso!',
                'data' => $registroBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar alimentação'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $registro = alimentacao::find($id);

        if (!$registro) {
            return response()->json([
                'success' => false,
                'message' => 'Alimentação não encontrada'
            ], 404);
        }

        if ($registro->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Alimentação excluída com sucesso!'
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro ao excluir alimentação'
        ], 500);
    }
}
