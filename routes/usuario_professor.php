<?php 

use App\Http\Controllers\OfertaAcaoController;
use App\Http\Controllers\ProfessorControllers\OfertaAcaoProfessorController;
use App\Http\Controllers\ProfessorControllers\OfertaProfessorController;
use Illuminate\Support\Facades\Route;

Route::prefix('professor')->group(function(){

    //Rota de cadastro para membros da sociedade 
    /* Route::prefix('/cadastro')->controller(CadastroMembroController::class)->group( function(){
        Route::get('/', 'index')->name('cadastro_membro_index');
        Route::post('/', 'create')->name('cadastro_create');
    });  AJUSTAR PORQUE É CÓPIA DO MEMBRO*/

    Route::prefix('/ofertas')->controller(OfertaProfessorController::class)->group(function (){
        Route::get('/visualizar', 'index')->name('oferta_index');
        Route::get('/cadastrar', 'createIndex')->name('oferta_create_index');
        Route::post('/acao', [OfertaAcaoProfessorController::class, 'createStoreAcao'])->name('oferta_create_store_acao');
        Route::post('/conhecimento', 'createStoreConhecimento')->name('oferta_create_store_conhecimento');
        Route::prefix('/{ofertaId}')->group(function (){
            Route::get('/edit', 'editIndex')->name('oferta_edit_index');
            Route::post('/edit', 'editStore')->name('oferta_edit_store');
            Route::delete('/delete', 'deleteStore')->name('oferta_delete_store');
        });
    });





    Route::prefix('extensao/ofertas')->group(function(){
        
        Route::get('/cadastrar_ofertas', function(){
            return view('ofertas_membro/cadastrar_ofertas');
        })->name('cadastrar_ofertas');
        Route::get('/sucesso_cadastro_oferta', function(){
            return view('ofertas_membro/sucesso_cadastro_oferta');
        })->name('sucesso_cadastro_oferta');
    });
    
});



