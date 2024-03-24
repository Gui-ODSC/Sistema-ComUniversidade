<?php 

use App\Http\Controllers\AreaConhecimentoController;
use App\Http\Controllers\BairroController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\MembroControllers\CadastroMembroController;
use App\Http\Controllers\MembroControllers\ContatoMembroController;
use App\Http\Controllers\MembroControllers\DemandaMembroController;
use App\Http\Controllers\MembroControllers\MatchingMembroController;
use App\Http\Controllers\MembroControllers\PerfilMembroController;
use App\Http\Controllers\UsuarioAlunoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioProfessorController;
use Illuminate\Support\Facades\Route;

//ROTAS REFERENTE A VISUALIZAÇÃO DOS USUÁRIOS MEMBROS DO SISTEMA
Route::prefix('membro')->group(function(){

    //Rota de cadastro para membros da sociedade 
    Route::prefix('/cadastro')->controller(CadastroMembroController::class)->group( function(){
        Route::get('/', 'index')->name('cadastro_index');
        Route::post('/', 'create')->name('cadastro_create');
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
                    Route::prefix('/contato')->controller(ContatoMembroController::class)->group(function () {
                        Route::post('/', 'create')->name('contato_store');
                    })->middleware('auth');
                });
            })->middleware('auth');
        })->middleware('auth');
    })->middleware('auth');

    Route::prefix('/contatos')->controller(ContatoMembroController::class)->group(function(){
        Route::get('/', 'list')->name('list_contatos_realizados');
    });

    Route::prefix('/perfil')->controller(PerfilMembroController::class)->group(function(){
        Route::get('/', 'index')->name('perfil_index');
        Route::prefix('/{usuarioId}')->group(function(){
            Route::get('/edit', 'editIndex')->name('perfil_edit_index');
            Route::post('/', 'editStore')->name('perfil_edit_store');
        })->middleware('auth');
    })->middleware('auth');















    

    /* //Rota de Recuperação de Senha FOI
    Route::get('/recuperacao_senha', function(){
        return view('recuperacao_senha');
    })->name('recuperacao_senha_membro');
 */
    //Rota de telas do usuario membros para demandas FOI
    /* Route::prefix('extensao/demanda')->group(function(){
        Route::get('/minhas_demandas', function(){
            return view('usuarioMembro/demanda/minhas_demandas');
        })->middleware('auth')->name('minhas_demandas_membro'); */

        /* //CADASTRAR
        Route::get('/cadastrar_demandas', function(){
            return view('usuarioMembro/demanda/cadastrar_demandas');
        })->name('cadastrar_demandas_membro');
        Route::get('/sucesso_cadastro_demanda', function(){
            return view('usuarioMembro/demanda/sucesso_cadastro_demanda');
        })->name('sucesso_cadastro_demanda_membro'); */

        //EDITAR
        /* Route::get('/editar_demandas', function(){
            return view('usuarioMembro/demanda/editar_demandas');
        })->name('editar_demandas_membro');
        Route::get('/sucesso_edicao_demanda', function(){
            return view('usuarioMembro/demanda/sucesso_edicao_demanda');
        })->name('sucesso_edicao_demanda_membro'); */    
    /* }); */

    //Rota de telas do usuario Membro para as telas de matching
    /* Route::prefix('extensao/matching')->group(function(){
        Route::get('/visualizar_matching_demanda', function(){
            return view('usuarioMembro/matching_demandas/visualizar_matching_demandas');
        })->name('visualizar_matching_demandas_membro');
    }); */

    //Rota de telas do usuario Membro para Todas as Ofertas FOI
    /* Route::prefix('extensao/')->group(function(){
        Route::get('/todas_ofertas_disponiveis', function(){
            return view('usuarioMembro/todas_ofertas/todas_ofertas_membro');
        })->name('todas_ofertas_membro');
    }); */

    //Rota de telas do usuario para configuracoes FOI
    /* Route::prefix('extensao/configuracoes_membro')->group(function(){
        Route::get('/configuracao', function(){
            return view('usuarioMembro/configuracao/configuracoes_membro');
        })->name('configuracoes');
        Route::get('/ajuda_sistema', function(){
            return view('usuarioMembro/configuracao/ajuda_sistema');
        })->name('ajuda_sistema');
        Route::get('/historico_demandas', function(){
            return view('usuarioMembro/configuracao/historico_demandas');
        })->name('historico_demandas');
        Route::get('/historico_ofertas', function(){
            return view('usuarioMembro/configuracao/historico_ofertas');
        })->name('historico_ofertas');
        Route::get('/enviar_feedback', function(){
            return view('usuarioMembro/configuracao/enviar_feedback');
        })->name('enviar_feedback');
        Route::get('/sobre_nos', function(){
            return view('usuarioMembro/configuracao/sobre_nos');
        })->name('sobre_nos');
    }); */

    //Rota de telas do usuario para perfil FOI
    /* Route::prefix('extensao/perfil')->group(function(){
        Route::get('/perfil_membro', function(){
            return view('usuarioMembro/perfil/perfil_membro');
        })->name('perfil_membro');
    }); */

    //Rota de telas do usuario para sair FOI
    /* Route::prefix('extensao/sair')->group(function(){
        Route::get('/sair_membro', function(){
            return view('usuarioMembro/sair/sair_membro');
        })->name('sair');
    }); */

    //Rota de Contatos Realizados pelo usuario membro FOI
    /* Route::prefix('extensao/contatos')->group(function(){
        Route::get('/contatos_realizados', function(){
            return view('usuarioMembro/contatos_realizados/todos_contatos_realizados');
        })->name('todos_contatos_realizados_membro');
    }); */

    //Rota de Contatos Recebidos pelo usuario membro FOI
    /* Route::prefix('extensao/contatos')->group(function(){
        Route::get('/contatos_recebidos', function(){
            return view('usuarioMembro/contatos_recebidos/todos_contatos_recebidos');
        })->name('todos_contatos_recebidos_membro');
    }); */

});


//ROTAS PARA FUNCIONALIDADES NO SISTEMA















// Route::prefix('teste/controllers')->controller(AreaConhecimentoController::class)->group(function() {
//     Route::get('/', 'list');
//     Route::post('/', 'create');
//     Route::prefix('/{id_area_conhecimento}')->group(function() {
//         Route::get('/', 'get');
//         Route::put('/', 'update');
//         Route::delete('/', 'delete');
//     });
// });

/* Route::prefix('teste/controllers')->controller(BairroController::class)->group(function() {
    Route::get('/', 'list');
    Route::post('/', 'create');
    Route::prefix('/{id_bairro}')->group(function() {
        Route::get('/', 'get');
        Route::put('/', 'update');
        Route::delete('/', 'delete');
    });
}); */

/* Route::prefix('teste/controllers')->controller(CidadeController::class)->group(function() {
    Route::get('/', 'list');
    Route::post('/', 'create');
    Route::prefix('/{id_cidade}')->group(function() {
        Route::get('/', 'get');
        Route::put('/', 'update');
        Route::delete('/', 'delete');
    });
}); */


/* Route::prefix('teste/controllers')->controller(EstadoController::class)->group(function() {
    Route::get('/', 'list');
    Route::post('/', 'create');
    Route::prefix('/{id_estado}')->group(function() {
        Route::get('/', 'get');
        Route::put('/', 'update');
        Route::delete('/', 'delete');
    });
}); */

// Route::prefix('teste/controllers')->controller(EnderecoController::class)->group(function() {
//     Route::get('/', 'list');
//     Route::post('/', 'create');
//     Route::prefix('/{id_endereco}')->group(function() {
//         Route::get('/', 'get');
//         Route::put('/', 'update');
//         Route::delete('/', 'delete');
//     });
// });

/* Route::prefix('teste/controllers')->controller(UsuarioController::class)->group(function() {
    Route::get('/', 'list');
    Route::post('/', 'create');
    Route::prefix('/{id_usuario}')->group(function() {
        Route::get('/', 'get');
        Route::put('/', 'update');
        Route::delete('/', 'delete');
    });
}); */

// Route::prefix('teste/controllers')->controller(UsuarioAlunoController::class)->group(function() {
//     Route::get('/', 'list');
//     Route::post('/', 'create');
//     Route::prefix('/{id_usuario}')->group(function() {
//         Route::get('/', 'get');
//         Route::put('/', 'update');
//         Route::delete('/', 'delete');
//     });
// });

// Route::prefix('teste/controllers')->controller(UsuarioProfessorController::class)->group(function() {
//     Route::get('/', 'list');
//     Route::post('/', 'create');
//     Route::prefix('/{id_usuario}')->group(function() {
//         Route::get('/', 'get');
//         Route::put('/', 'update');
//         Route::delete('/', 'delete');
//     });
// });

/* Route::prefix('teste/controllers')->controller(DemandaController::class)->group(function() {
    Route::get('/', 'list');
    Route::post('/', 'create');
    Route::prefix('/{id_usuario}')->group(function() {
        Route::get('/', 'get');
        Route::put('/', 'update');
        Route::delete('/', 'delete');
    });
}); */