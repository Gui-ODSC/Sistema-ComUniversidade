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
Route::prefix('/autenticacao')->group(function(){
    Route::get('/login_membro', function(){
        return view('autenticacaoUsuario/login_membro');
    })->name('login_membro');
    Route::get('/login_aluno', function(){
        return view('autenticacaoUsuario/login_aluno');
    })->name('login_aluno');
    Route::get('/login_professor', function(){
        return view('autenticacaoUsuario/login_professor');
    })->name('login_professor');
});

//ROTAS USUARIOS MEMBRO
include 'usuario_membro_routes.php';

//ROTAS USUARIO PROFESSOR
include 'usuario_professor_routes.php';

//ROTAS USUARIO ALUNO
include 'usuario_aluno_routes.php';







