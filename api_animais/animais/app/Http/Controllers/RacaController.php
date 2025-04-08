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
    public function show(raca $raca)
    {
        $regBook = raca::find($id);

        if ($regBook) {
            return 'raça Localizada: '.$regBook.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'raça não locaizada, '.Response()->json([],Response::HTTP_NO_CONTENT);
    
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, raca $raca)
    {
        $validator = Validator::make($request->all(), [
            'Nome_da_raca' => 'required',
            'Tamanho' => 'required',
            'idade' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'sucess' => false,
                'message' => 'Registros Invalidos',
                'errors' => $validator->erros()


            ], 400);
        }

        $regBookBanco = raca::find($id);

        if (!$regBookBanco) {
            return response()->json([
                'success' => false,
                'message' => 'raça não encontrado'
            ], 404);
        }

        $regBookBanco->nomeLivro = $request->nomeLivro;
        $regBookBanco->generoLivro = $request->generoLivro;
        $regBookBanco->anoLivro = $request->anoLivro;

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
    public function destroy(raca $raca)
    {
        $regBook = raca::find($id);

        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'raca não encontrado'
            ], 404);
        }
        if ($regBook->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'raca deletado com sucesso'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a raca'
        ], 500);
    }
    }

