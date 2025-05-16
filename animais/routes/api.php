<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RacaController;
use App\Http\Controllers\AlimentacaoController;

// Usuário autenticado (sanctum)

// ROTA TESTE (página inicial da API)
Route::get('/', function () {
    return response()->json(['sucesso' => true, 'message' => 'API está ativa!']);
});

// ROTAS DE VISUALIZAÇÃO (para consulta pública)
Route::get('/raca', [RacaController::class, 'index']);
Route::get('/raca/{id}', [RacaController::class, 'show']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// RAÇA
Route::get('/raca', [RacaController::class, 'index']);            // Listar todas as raças
Route::post('/raca', [RacaController::class, 'store']);            // Criar nova raça
Route::get('/raca/{id}', [RacaController::class, 'show']);         // Visualizar raça específica
Route::put('/raca/{id}', [RacaController::class, 'update']);       // Atualizar raça inteira
Route::patch('/raca/{id}', [RacaController::class, 'update']);     // Atualizar parcialmente
Route::delete('/raca/{id}', [RacaController::class, 'destroy']);   // Deletar raça

// ALIMENTAÇÃO
Route::get('/alimentacao', [AlimentacaoController::class, 'index']);           // Listar todas as alimentações
Route::post('/alimentacao', [AlimentacaoController::class, 'store']);          // Criar nova alimentação
Route::get('/alimentacao/{id}', [AlimentacaoController::class, 'show']);       // Visualizar alimentação específica
Route::put('/alimentacao/{id}', [AlimentacaoController::class, 'update']);     // Atualizar alimentação inteira
Route::patch('/alimentacao/{id}', [AlimentacaoController::class, 'update']);   // Atualizar parcialmente
Route::delete('/alimentacao/{id}', [AlimentacaoController::class, 'destroy']); // Deletar alimentação
