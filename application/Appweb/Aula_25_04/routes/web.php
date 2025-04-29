<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriptomoedaController;

// Listagem
Route::get('/', [CriptomoedaController::class, 'index'])->name('criptomoedas.index');

// Formulário de criação
Route::get('/create', [CriptomoedaController::class, 'create'])->name('criptomoedas.create');

// Enviar dados do formulário de criação
Route::post('/store', [CriptomoedaController::class, 'store'])->name('criptomoedas.store');

// Formulário de edição
Route::get('/edit/{id}', [CriptomoedaController::class, 'edit'])->name('criptomoedas.edit');

// Enviar dados do formulário de edição
Route::put('/update/{id}', [CriptomoedaController::class, 'update'])->name('criptomoedas.update');

// Deletar
Route::delete('/delete/{id}', [CriptomoedaController::class, 'destroy'])->name('criptomoedas.destroy');

Route::get('/criptomoedas/ajax/listar', [CriptomoedaController::class, 'listar'])->name('criptomoedas.ajax.listar');