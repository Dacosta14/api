<?php

namespace App\Http\Controllers;

use App\Models\alimentacao;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;




class AlimentacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = alimentacao::all();
        $contador = $regBook->count();

        return Response()->json($regBook);    }

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
                'sucess' => false,
                'message' => 'Resgistros invalidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registros = alimentacao::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'alimentação atualizada com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar a alimentação'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $regBook = alimentacao::find($id);
    
        if ($regBook) {
            return response()->json([
                'success' => true,
                'message' => 'Alimentação localizada',
                'data' => $regBook
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Alimentação não localizada'
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
            'message' => 'Registros inválidos',
            'errors' => $validator->errors()
        ], 400);
    }

    $regBookBanco = alimentacao::find($id);

    if (!$regBookBanco) {
        return response()->json([
            'success' => false,
            'message' => 'Alimentação não encontrada'
        ], 404);
    }

    $regBookBanco->quantiadade = $request->quantiadade;
    $regBookBanco->horario_alimentacao = $request->horario_alimentacao;
    $regBookBanco->tipo_racao = $request->tipo_racao;

    if ($regBookBanco->save()) {
        return response()->json([
            'success' => true,
            'message' => 'Alimentação atualizada com sucesso!',
            'data' => $regBookBanco
        ], 200);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Erro ao atualizar a alimentação'
        ], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regBook = alimentacao::find($id);
    
        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'Alimentação não encontrada'
            ], 404);
        }
    
        if ($regBook->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Alimentação deletada com sucesso'
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a alimentação'
        ], 500);
    }
    
    }
