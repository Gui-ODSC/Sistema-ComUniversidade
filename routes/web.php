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


//ROTAS REFERENTE AOS USUÁRIOS MEMBROS DO SISTEMA
Route::prefix('membro')->group(function(){

    //Rota de cadastro para membros da sociedade FOI
    Route::get('/cadastro', function(){
        return view('usuarioMembro/cadastro/cadastro_membro');
    })->name('cadastro_membro');

    //Rota de Recuperação de Senha FOI
    Route::get('/recuperacao_senha', function(){
        return view('recuperacao_senha');
    })->name('recuperacao_senha');

    //Rota de telas do usuario membros para demandas FOI
    Route::prefix('extensao/demanda')->group(function(){
        Route::get('/minhas_demandas', function(){
            return view('usuarioMembro/demanda/minhas_demandas');
        })->name('minhas_demandas');
        Route::get('/cadastrar_demandas', function(){
            return view('usuarioMembro/demanda/cadastrar_demandas');
        })->name('cadastrar_demandas');
        Route::get('/sucesso_cadastro_demanda', function(){
            return view('usuarioMembro/demanda/sucesso_cadastro_demanda');
        })->name('sucesso_cadastro_demanda');
    });

    //Rota de telas do usuario Membro para Todas as Ofertas FOI
    Route::prefix('extensao/')->group(function(){
        Route::get('/todas_ofertas_disponiveis', function(){
            return view('usuarioMembro/todas_ofertas/todas_ofertas_membro');
        })->name('todas_ofertas');
    });

    //Rota de telas do usuario para configuracoes FOI
    Route::prefix('extensao/configuracoes_membro')->group(function(){
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
    });

    //Rota de telas do usuario para perfil FOI
    Route::prefix('extensao/perfil')->group(function(){
        Route::get('/perfil_membro', function(){
            return view('usuarioMembro/perfil/perfil_membro');
        })->name('perfil');
    });

    //Rota de telas do usuario para sair FOI
    Route::prefix('extensao/sair')->group(function(){
        Route::get('/sair_membro', function(){
            return view('usuarioMembro/sair/sair_membro');
        })->name('sair');
    });

    //Rota de Contatos Realizados pelo usuario membro FOI
    Route::prefix('extensao/contatos')->group(function(){
        Route::get('/contatos_realizados', function(){
            return view('usuarioMembro/contatos_realizados/todos_contatos_realizados');
        })->name('todos_contatos_realizados');
    });

    //Rota de Contatos Recebidos pelo usuario membro FOI
    Route::prefix('extensao/contatos')->group(function(){
        Route::get('/contatos_recebidos', function(){
            return view('usuarioMembro/contatos_recebidos/todos_contatos_recebidos');
        })->name('todos_contatos_recebidos');
    });

});


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
