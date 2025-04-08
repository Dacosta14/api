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
    public function show(alimentacao $alimentacao)
    {
        $regBook = alimentacao::find($id);

        if ($regBook) {
            return 'alimentacao Localizados: '.$regBook.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'alimentacao não locaizados, '.Response()->json([],Response::HTTP_NO_CONTENT);
    
        }     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, alimentacao $alimentacao)
    {
        $validator = Validator::make($request->all(), [
            'quantiadade' => 'required',
            'horario_alimentacao' => 'required',
            'tipo_racao' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'sucess' => false,
                'message' => 'Registros Invalidos',
                'errors' => $validator->erros()


            ], 400);
        }

        $regBookBanco = alimentacao::find($id);

        if (!$regBookBanco) {
            return response()->json([
                'success' => false,
                'message' => 'alimentacão não encontrada'
            ], 404);
        }

        $regBookBanco->nomeLivro = $request->nomeLivro;
        $regBookBanco->generoLivro = $request->generoLivro;
        $regBookBanco->anoLivro = $request->anoLivro;

        if ($regBookBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'alimentação atualizado com sucesso!',
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
    public function destroy(alimentacao $alimentacao)
    {
        $regBook = alimentacao::find($id);

        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'alimentacao não encontrado'
            ], 404);
        }
        if ($regBook->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'alimentacao deletado com sucesso'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a alimentacao'
        ], 500);
    }
    }
