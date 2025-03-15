<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MotosController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/',function(){return response()->json(['sucesso'=>true]);});
Route::get('/motos', [MotosController::class, 'index']);
Route::post('/motos', [MotosController::class, 'store']);