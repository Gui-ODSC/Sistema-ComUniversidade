<?php 

use App\Http\Controllers\OfertaAcaoController;
use App\Http\Controllers\ProfessorControllers\OfertaAcaoProfessorController;
use App\Http\Controllers\ProfessorControllers\OfertaConhecimentoProfessorController;
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
        Route::post('/conhecimento', [OfertaConhecimentoProfessorController::class, 'createStoreConhecimento'])->name('oferta_create_store_conhecimento');
        Route::prefix('/{ofertaId}')->group(function (){
            Route::get('/edit_acao', 'editIndexAcao')->name('oferta_edit_index_acao');
            Route::get('/edit_conhecimento', 'editIndexConhecimento')->name('oferta_edit_index_conhecimento');
            Route::post('/edit_acao', [OfertaAcaoProfessorController::class, 'editStoreAcao'])->name('oferta_edit_store_acao');
            Route::post('/edit_conhecimento', [OfertaConhecimentoProfessorController::class, 'editStoreConhecimento'])->name('oferta_edit_store_conhecimento');
            Route::delete('/delete_acao', [OfertaAcaoProfessorController::class, 'deleteStoreAcao'])->name('oferta_delete_store_acao');
            Route::delete('/delete_conhecimento', [OfertaConhecimentoProfessorController::class, 'deleteStoreConhecimento'])->name('oferta_delete_store_conhecimento');
        });
    });

});



