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

//Rota Inicial de seleção de entrada
Route::get('/', function(){
    return view('inicial');
})->name('inicial');

//Rotas de Login específicas para cada tipo de usuário
Route::prefix('autenticacao')->group(function(){
    Route::get('/login_membro', function(){
        return view('autenticacao_usuario/login_membro');
    })->name('login_membro');
    Route::get('/login_aluno', function(){
        return view('autenticacao_usuario/login_aluno');
    })->name('login_aluno');
    Route::get('/login_professor', function(){
        return view('autenticacao_usuario/login_professor');
    })->name('login_professor');
});

//Rota de cadastro para membros da sociedade
Route::prefix('cadastro')->group(function(){
    Route::get('/membro_sociedade', function(){
        return view('cadastro_usuario/membro_sociedade');
    })->name('cadastro_membro');
});

//Rota de Recuperação de Senha
Route::get('/recuperacao_senha', function(){
    return view('recuperacao_senha');
})->name('recuperacao_senha');
