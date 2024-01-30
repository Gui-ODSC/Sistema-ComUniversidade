<?php 

use Illuminate\Support\Facades\Route;

Route::prefix('professor')->group(function(){

    //Rota de telas do usuario professor para ofertas
    Route::prefix('extensao/ofertas')->group(function(){
        Route::get('/minhas_ofertas', function(){
            return view('ofertas_membro/minhas_ofertas');
        })->name('minhas_ofertas');
        Route::get('/cadastrar_ofertas', function(){
            return view('ofertas_membro/cadastrar_ofertas');
        })->name('cadastrar_ofertas');
        Route::get('/sucesso_cadastro_oferta', function(){
            return view('ofertas_membro/sucesso_cadastro_oferta');
        })->name('sucesso_cadastro_oferta');
    });
    
});



