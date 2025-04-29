<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CriptomoedaController; 

Route::get( '/', [CriptomoedaController::class,'index'])->name('criptomoedas.index');

Route::get( '/create', [CriptomoedaController::class,'create'])->name('criptomoedas.create');
Route::post( '/store', [CriptomoedaController::class,'store'])->name('criptomoedas.store');