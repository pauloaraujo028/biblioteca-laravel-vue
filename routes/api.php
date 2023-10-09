<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AluguelController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LivroController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios/create', [UsuarioController::class, 'create']);
Route::post('/usuarios', [UsuarioController::class, 'store']);
Route::get('/usuarios/{usuario_id}', [UsuarioController::class, 'show']);
Route::get('/usuarios/{usuario_id}/edit', [UsuarioController::class, 'edit']);
Route::put('/usuarios/{usuario_id}', [UsuarioController::class, 'update']);
Route::delete('/usuarios/{usuario_id}', [UsuarioController::class, 'destroy']);

Route::get('/livros', [LivroController::class, 'index']);
Route::get('/livros/create', [LivroController::class, 'create']);
Route::post('/livros', [LivroController::class, 'store']);
Route::get('/livros/{livro_id}', [LivroController::class, 'show']);
Route::get('/livros/{livro_id}/edit', [LivroController::class, 'edit']);
Route::put('/livros/{livro_id}', [LivroController::class, 'update']);
Route::delete('/livros/{livro_id}', [LivroController::class, 'destroy']);

Route::get('/alugueis', [AluguelController::class, 'index']);
Route::get('/alugueis/create', [AluguelController::class, 'create']);
Route::post('/alugueis', [AluguelController::class, 'store']);
Route::get('/alugueis/{aluguel_id}', [AluguelController::class, 'show']);
Route::get('/alugueis/{aluguel_id}/edit', [AluguelController::class, 'edit']);
Route::put('/alugueis/{aluguel_id}', [AluguelController::class, 'update']);
Route::delete('/alugueis/{aluguel_id}', [AluguelController::class, 'destroy']);

Route::get('/alugueis-txt', [AluguelController::class, 'exportarAlugueisParaTxt']);
