<?php

use App\Http\Controllers\EstudanteControllers\LoginEstudanteController;
use App\Http\Controllers\MembroControllers\LoginMembroController;
use App\Http\Controllers\ProfessorControllers\LoginProfessorController;
use App\Http\Controllers\ResetPasswordController;
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
    Route::prefix('/login_membro')->group( function(){
        Route::get('/login', [LoginMembroController::class, 'index'])->name('login_membro_index');
        Route::post('/login', [LoginMembroController::class, 'login'])->name('login_membro_store');
        Route::get('/logout', [LoginMembroController::class, 'logout'])->name('login_membro_destroy');
        Route::get('/', [LoginMembroController::class, 'logout_index'])->name('logout_membro_index');
    });

    Route::prefix('/login_professor')->group(function(){
        Route::get('/login', [LoginProfessorController::class, 'index'])->name('login_professor_index');
        Route::post('/login', [LoginProfessorController::class, 'login'])->name('login_professor_store');
        Route::get('/logout', [LoginProfessorController::class, 'logout'])->name('login_professor_destroy');
        Route::get('/', [LoginProfessorController::class, 'logout_index'])->name('logout_professor_index');
    });

    Route::prefix('/login_estudantes')->group(function(){
        Route::get('/login', [LoginEstudanteController::class, 'index'])->name('login_estudante_index');
        Route::post('/login', [LoginEstudanteController::class, 'login'])->name('login_estudante_store');
        Route::get('/logout', [LoginEstudanteController::class, 'logout'])->name('login_estudante_destroy');
        Route::get('/', [LoginEstudanteController::class, 'logout_index'])->name('logout_estudante_index');
    });

    Route::prefix('/redefinir_senha')->controller(ResetPasswordController::class)->group( function(){
        Route::get('/', 'showResetPasswordForm')->name('reset_index');
        Route::post('/', 'sendEmailPassword')->name('send_email_password');
        Route::get('/{token}', 'resetPassword')->name('reset_password');
        Route::post('/new_password', 'newPassword')->name('new_password');
    });


    Route::get('/templateEmail', function(){
        return view('emails.email_forget_password');
    });
    
});







