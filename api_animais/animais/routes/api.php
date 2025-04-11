<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RacaController;
use App\Http\Controllers\AlimentacaoController;

// Rota para obter o usuário autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rota para listar todas as raças
Route::get('/raca', [RacaController::class, 'index']);

// Rota para criar uma nova raça
Route::post('/raca', [RacaController::class, 'store']);

// Rota para visualizar uma raça específica
Route::get('/raca/{id}', [RacaController::class, 'show']);

// Rota para atualizar uma raça
Route::put('/raca/{id}', [RacaController::class, 'update']);

Route::patch('/raca/{id}', [RacaController::class, 'update']);

// Rota para deletar uma raça
Route::delete('/raca/{id}', [RacaController::class, 'destroy']);

//ALIMENTAÇÃO

// Rota para listar todas as alimentações
Route::get('/alimentacao', [AlimentacaoController::class, 'index']);

// Rota para criar uma nova alimentação
Route::post('/alimentacao', [AlimentacaoController::class, 'store']);

// Rota para visualizar uma alimentação específica
Route::get('/alimentacao/{id}', [AlimentacaoController::class, 'show']);

// Rota para atualizar uma alimentação
Route::put('/alimentacao/{id}', [AlimentacaoController::class, 'update']);
Route::patch('/alimentacao/{id}', [AlimentacaoController::class, 'update']);

// Rota para deletar uma alimentação
Route::delete('/alimentacao/{id}', [AlimentacaoController::class, 'destroy']);