<?php

namespace App\Http\Controllers;

use App\Models\criptomoedas;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CriptomoedasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regBook = Criptomoedas::all();
        $contador = $regBook->count();

        return Response()->json($regBook);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sigla' => 'required',
            'nome' => 'required',
            'valor' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'sucess' => false,
                'message' => 'Resgistros invalidos',
                'errors' => $validator->errors()
            ], 400);
        }

        $registros = Criptomoedas::create($request->all());

        if ($registros) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoeda cadastrada com sucesso!',
                'data' => $registros
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar a criptomoeda'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(criptomoedas $criptomoedas)
    {
        $regBook = Criptomoedas::find($id);

        if ($regBook) {
            return 'Criptomoedas Localizados: '.$regBook.Response()->json([], Response::HTTP_NO_CONTENT);
        }else{
            return 'Criptomoedas não locaizados, '.Response()->json([],Response::HTTP_NO_CONTENT);
    
        } 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, criptomoedas $criptomoedas)
    {
        $validator = Validator::make($request->all(), [
            'sigla' => 'required',
            'nome' => 'required',
            'valor' => 'required'
        ]);
        if ($validator->fails()){
            return response()->json([
                'sucess' => false,
                'message' => 'Registros Invalidos',
                'errors' => $validator->erros()


            ], 400);
        }

        $regBookBanco = Criptomoedas::find($id);

        if (!$regBookBanco) {
            return response()->json([
                'success' => false,
                'message' => 'Criptomoeda não encontrado'
            ], 404);
        }

        $regBookBanco->nomeLivro = $request->nomeLivro;
        $regBookBanco->generoLivro = $request->generoLivro;
        $regBookBanco->anoLivro = $request->anoLivro;

        if ($regBookBanco->save()) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoeda atualizado com sucesso!',
                'data' => $regBookBanco
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar a criptomoeda'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(criptomoedas $criptomoedas)
    {
        $regBook = Criptomoeda::find($id);

        if (!$regBook) {
            return response()->json([
                'success' => false,
                'message' => 'criptomoeda não encontrado'
            ], 404);
        }
        if ($regBook->delete()) {
            return response()->json([
                'success' => true,
                'message' => 'Criptomoeda deletado com sucesso'
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Erro ao deletar a criptomoeda'
        ], 500);
    }
}
