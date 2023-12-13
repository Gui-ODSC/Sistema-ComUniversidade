<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('extensao')->group(function(){
    //Rota Inicial de seleção de entrada
    Route::get('/inicial', function(){
        return view('inicial');
    })->name('inicial');

    //Rotas de Login específicas para cada tipo de usuário
    Route::get('/login_membro', function(){
        return view('login_membro');
    })->name('login_membro');
    Route::get('/login_aluno', function(){
        return view('login_aluno');
    })->name('login_aluno');
    Route::get('/login_professor', function(){
        return view('login_professor');
    })->name('login_professor');
});
