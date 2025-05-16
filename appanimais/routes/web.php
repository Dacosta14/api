<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RacaController;
use App\Http\Controllers\AlimentacaoController;

// Listagem dos quartos


Route::get('/', [RacaController::class, 'index'])->name('racas.index');

Route::get('/raca/create', function () {
    return 'Página de criação de raça';
})->name('raca.create');

Route::resource('raca', RacaController::class);

// Formulário de criação de quarto
Route::get('/create', [RacaController::class, 'create'])->name('racas.create');

// Enviar dados do formulário de criação de quarto
Route::post('/store', [RacaController::class, 'store'])->name('racas.store');

// Formulário de edição de quarto
Route::get('/edit/{id}', [RacaController::class, 'edit'])->name('racas.edit');

// Enviar dados do formulário de edição de quarto
Route::put('/update/{id}', [RacaController::class, 'update'])->name('racas.update');

// Deletar quarto
Route::delete('/delete/{id}', [RacaController::class, 'destroy'])->name('racas.destroy');

Route::get('/raca/{id}/edit', [RacaController::class, 'edit'])->name('raca.edit');

// Rotas para Reservas
Route::get('/alimentacao', [AlimentacaoController::class, 'index'])->name('alimentacao.index');
Route::get('/alimentacao/create', [AlimentacaoController::class, 'create'])->name('alimentacao.create');
Route::post('/alimentacao/store', [AlimentacaoController::class, 'store'])->name('alimentacao.store');
Route::get('/alimentacao/edit/{id}', [AlimentacaoController::class, 'edit'])->name('alimentacao.edit');
Route::put('/alimentacao/update/{id}', [AlimentacaoController::class, 'update'])->name('alimentacao.update');
Route::delete('/alimentacao/delete/{id}', [AlimentacaoController::class, 'destroy'])->name('alimentacao.destroy');
