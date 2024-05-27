<?php 

use App\Http\Controllers\CepController;
use App\Http\Controllers\MembroControllers\CadastroMembroController;
use App\Http\Controllers\MembroControllers\ContatoRealizadoMembroController;
use App\Http\Controllers\MembroControllers\ContatoRecebidoMembroController;
use App\Http\Controllers\MembroControllers\DemandaMembroController;
use App\Http\Controllers\MembroControllers\MatchingMembroController;
use App\Http\Controllers\MembroControllers\PerfilMembroController;
use App\Http\Controllers\MembroControllers\TodasOfertasMembroController;
use App\Http\Middleware\AuthMembro;
use Illuminate\Support\Facades\Route;

//ROTAS REFERENTE A VISUALIZAÇÃO DOS USUÁRIOS MEMBROS DO SISTEMA
Route::prefix('membro')->group(function(){

    Route::get('/api/cep/{cep}', [CepController::class, 'getCepData'])->withoutMiddleware(AuthMembro::class);
    
    //Rota de cadastro para membros da sociedade 
    Route::prefix('/cadastro')->controller(CadastroMembroController::class)->group( function(){
        Route::get('/', 'index')->name('cadastro_membro_index')->withoutMiddleware(AuthMembro::class);
        Route::post('/', 'create')->name('cadastro_create')->withoutMiddleware(AuthMembro::class);
    });

    Route::prefix('/demandas')->controller(DemandaMembroController::class)->group(function(){
        Route::get('/visualizar', 'index')->name('demanda_index');
        Route::get('/cadastrar', 'createIndex')->name('demanda_create_index');
        Route::post('/', 'createStore')->name('demanda_create_store');
        Route::prefix('/{demandaId}')->group(function (){
            Route::get('/edit', 'editIndex')->name('demanda_edit_index');
            Route::post('/edit', 'editStore')->name('demanda_edit_store');
            Route::delete('/delete', 'deleteStore')->name('demanda_delete_store');
            /* MATCHINGS */
            Route::prefix('/matchings')->controller(MatchingMembroController::class)->group(function (){
                Route::get('/list', 'matchingList')->name('demanda_matching_index');
                Route::prefix('/{ofertaId}')->group(function() {
                    Route::post('/remove', 'matching_remover')->name('matching_remover');
                    Route::get('/visualizar', 'matching_status_visualizar')->name('matching_visualizar');
                    /* CONTATO */
                    Route::prefix('/contato')->controller(ContatoRealizadoMembroController::class)->group(function () {
                        Route::post('/', 'create')->name('contato_realizado_store');
                    })->middleware('auth');
                });
            })->middleware('auth');
        })->middleware('auth');
    })->middleware('auth');

    Route::prefix('/contatos_realizados')->controller(ContatoRealizadoMembroController::class)->group(function(){
        Route::get('/', 'list')->name('list_contatos_realizados');
    });

    Route::prefix('/contatos-recebidos')->controller(ContatoRecebidoMembroController::class)->group(function() {
        Route::get('/', 'list')->name('list_contatos_recebidos');
        Route::prefix('/{contatoId}')->group(function(){
            Route::post('/', 'resposta')->name('contato_recebido_store');
        });
    });

    Route::prefix('/perfil')->controller(PerfilMembroController::class)->group(function(){
        Route::get('/', 'index')->name('perfil_index');
        Route::prefix('/{usuarioId}')->group(function(){
            Route::get('/edit', 'editIndex')->name('perfil_edit_index');
            Route::post('/', 'editStore')->name('perfil_edit_store');
        })->middleware('auth');
    })->middleware('auth');

    Route::prefix('/todas-ofertas')->controller(TodasOfertasMembroController::class)->group(function(){
        Route::get('/', 'listaOfertas')->name('list_todas_ofertas');
        Route::prefix('/{ofertaId}')->group(function (){
            Route::post('/', 'create')->name('contato_direto_store');
            Route::post('/visualizar', 'contato_direto_status_visualizar')->name('contato_direto_visualizar');
            Route::post('/remover', 'contatos_diretos_remover')->name('contato_direto_remover');
        });
    });

    Route::prefix('extensao/configuracoes_membro')->group(function(){
        Route::get('/configuracao', function(){
            return view('usuarioMembro/configuracao/configuracoes_membro');
        })->name('configuracoes');
        Route::get('/ajuda_sistema', function(){
            return view('usuarioMembro/configuracao/ajuda_sistema');
        })->name('ajuda_sistema');
        Route::get('/enviar_feedback', function(){
            return view('usuarioMembro/configuracao/enviar_feedback');
        })->name('enviar_feedback');
        Route::get('/sobre_nos', function(){
            return view('usuarioMembro/configuracao/sobre_nos');
        })->name('sobre_nos');
    });
});
