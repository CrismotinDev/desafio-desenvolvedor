<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversaoController;
use App\Http\Controllers\LoginController;



Route::get('/', [LoginController::class, 'formLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/formulario-conversao-moeda', [ConversaoController::class, 'formCotacao'])->name('conversao-moeda');
Route::post('/cotacao-moeda', [ConversaoController::class, 'resultadoCotacao'])->name('cotacao-moeda');
Route::get('/resultado-conversao-moeda', [ConversaoController::class, 'tabelaExibindoResultadoCotacao'])->name('tabela-cotacao-moeda');
Route::get('/listar-cotacoes', [ConversaoController::class, 'listarCotacoes'])->name('listar-cotacoes');
Route::delete('/excluir-cotacao/{index}', [ConversaoController::class, 'excluirCotacao'])->name('excluir-cotacao');
Route::get('/enviar-cotacao-email', [ConversaoController::class, 'enviarCotacaoEmail'])->name('enviar-cotacao-email');
