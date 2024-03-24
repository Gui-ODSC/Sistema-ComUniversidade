<?php

use App\Http\Controllers\MembroControllers\LoginMembroController;
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
        Route::get('/login', [LoginMembroController::class, 'index'])->name('login_index');
        Route::post('/login', [LoginMembroController::class, 'login'])->name('login_store');
        Route::get('/logout', [LoginMembroController::class, 'logout'])->name('login_destroy');
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





    /* arrumar depois */
    Route::get('/login_aluno', function(){
        return view('autenticacaoUsuario/login_aluno');
    })->name('login_aluno');
    
    Route::get('/login_professor', function(){
        return view('autenticacaoUsuario/login_professor');
    })->name('login_professor');
});







