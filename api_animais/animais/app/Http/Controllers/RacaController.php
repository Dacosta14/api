<?php

namespace App\Http\Controllers;

use App\Models\raca;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RacaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = raca::all();
        $contador = $regBook->count();

        return Response()->json($regBook);
    }

    /**
     * Store a newly created resource in storage.
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
                'sucess' => false,
                'message' => 'Resgistros invalidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registros = raca::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'raça cadastrada com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar a raça'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $regBook = raca::find($id);
    
        if ($regBook) {
            return response()->json([
                'success' => true,
                'data' => $regBook
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Raça não localizada'
            ], 404);
        }
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $regBookBanco = raca::find($id);

        $validator = Validator::make($request->all(), [
            'Nome_da_raca' => 'required',
            'Tamanho' => 'required',
            'idade' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'sucess' => false,
                'message' => 'Registros Invalidos',
                'errors' => $validator->errors()



            ], 400);
        }

        

if (!$regBookBanco) {
    return response()->json([
        'success' => false,
        'message' => 'Raça não encontrada'
    ], 404);
}

$regBookBanco->Nome_da_raca = $request->Nome_da_raca;
$regBookBanco->Tamanho = $request->Tamanho;
$regBookBanco->idade = $request->idade;
        

        if ($regBookBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'raça atualizado com sucesso!',
                'data' => $regBookBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a raça'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $regBook = raca::find($id);
    
        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'Raça não encontrada'
            ], 404);
        }
    
        if ($regBook->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Raça deletada com sucesso'
            ], 200);
        }
    
        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a raça'
        ], 500);
    }
    
    }

