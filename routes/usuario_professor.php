<?php 

use App\Http\Controllers\ProfessorControllers\ContatoRecebidoProfessorController;
use App\Http\Controllers\ProfessorControllers\OfertaAcaoProfessorController;
use App\Http\Controllers\ProfessorControllers\ContatoRealizadoProfessorController;
use App\Http\Controllers\ProfessorControllers\OfertaConhecimentoProfessorController;
use App\Http\Controllers\ProfessorControllers\OfertaProfessorController;
use App\Http\Controllers\ProfessorControllers\MatchingProfessorController;
use Illuminate\Support\Facades\Route;

Route::prefix('professor')->group(function(){

    //Rota de cadastro para membros da sociedade 
    /* Route::prefix('/cadastro')->controller(CadastroMembroController::class)->group( function(){
        Route::get('/', 'index')->name('cadastro_membro_index');
        Route::post('/', 'create')->name('cadastro_create_professor');
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
            /* MATCHINGS */
            Route::prefix('/matchings')->controller(MatchingProfessorController::class)->group(function (){
                Route::get('/list', 'matchingList')->name('oferta_matching_index');
                Route::prefix('/{demandaId}')->group(function() {
                    Route::post('/remove', 'matching_remover_demanda')->name('matching_remover_demanda');
                    Route::get('/visualizar', 'matching_status_visualizar_demanda')->name('matching_visualizar_demanda');
                    /* CONTATO */
                    Route::prefix('/contato')->controller(ContatoRealizadoProfessorController::class)->group(function() {
                        Route::post('/', 'createContato')->name('contato_realizado_store_professor');
                    });
                });
            })->middleware('auth');
        })->middleware('auth');
    })->middleware('auth');

    Route::prefix('/contatos_realizados')->controller(ContatoRealizadoProfessorController::class)->group(function() {
        Route::get('/', 'listaContatosRealizados')->name('lista_contatos_realizados_professor');
    });

    Route::prefix('/contatos_recebidos')->controller(ContatoRecebidoProfessorController::class)->group(function() {
        Route::get('/', 'listaContatosRecebidos')->name('lista_contatos_recebidos_professor');
        Route::prefix('/{contatoId}')->group(function() {
            Route::post('/prof', 'repostaContato')->name('contato_recebido_store_professor');
        });
    });

    Route::prefix('extensao/configuracoes_professor')->group(function(){
        Route::get('/configuracao', function(){
            return view('usuarioProfessor/configuracao/configuracoes_professor');
        })->name('configuracoes_professor');
        Route::get('/ajuda_sistema', function(){
            return view('usuarioProfessor/configuracao/ajuda_sistema');
        })->name('ajuda_sistema');
        Route::get('/enviar_feedback', function(){
            return view('usuarioProfessor/configuracao/enviar_feedback');
        })->name('enviar_feedback');
        Route::get('/sobre_nos', function(){
            return view('usuarioProfessor/configuracao/sobre_nos');
        })->name('sobre_nos');
    });
});



