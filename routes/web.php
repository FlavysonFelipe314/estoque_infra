<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('usuario')->group(function (){
    Route::get('/', [UserController::class, 'index'])->name('usuario.index');
    Route::post('/store', [UserController::class, 'store'])->name('usuario.store');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('usuario.update');
    Route::delete('/destroy/{user}', [UserController::class, 'destroy'])->name('usuario.destroy');
});

Route::prefix('categoria')->group(function (){
    Route::get('/', [CategoriaController::class, 'index'])->name('categoria.index');
    Route::post('/store', [CategoriaController::class, 'store'])->name('categoria.store');
    Route::put('/update/{categoria}', [CategoriaController::class, 'update'])->name('categoria.update');
    Route::delete('/destroy/{categoria}', [CategoriaController::class, 'destroy'])->name('categoria.destroy');
});

Route::prefix('unidade')->group(function (){
    Route::get('/', [UnidadeController::class, 'index'])->name('unidade.index');
    Route::post('/store', [UnidadeController::class, 'store'])->name('unidade.store');
    Route::put('/update/{unidade}', [UnidadeController::class, 'update'])->name('unidade.update');
    Route::delete('/destroy/{unidade}', [UnidadeController::class, 'destroy'])->name('unidade.destroy');
});

Route::prefix('fornecedor')->group(function (){
    Route::get('/', [FornecedorController::class, 'index'])->name('fornecedor.index');
    Route::post('/store', [FornecedorController::class, 'store'])->name('fornecedor.store');
    Route::put('/update/{fornecedor}', [FornecedorController::class, 'update'])->name('fornecedor.update');
    Route::delete('/destroy/{fornecedor}', [FornecedorController::class, 'destroy'])->name('fornecedor.destroy');
});