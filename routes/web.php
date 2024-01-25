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
Route::prefix('autenticacao')->group(function(){
    Route::get('/login_membro', function(){
        return view('autenticacao_usuario/login_membro');
    })->name('login_membro');
    Route::get('/login_aluno', function(){
        return view('autenticacao_usuario/login_aluno');
    })->name('login_aluno');
    Route::get('/login_professor', function(){
        return view('autenticacao_usuario/login_professor');
    })->name('login_professor');
});

//Rota de cadastro para membros da sociedade
Route::prefix('cadastro')->group(function(){
    Route::get('/membro_sociedade', function(){
        return view('cadastro_usuario/membro_sociedade');
    })->name('cadastro_membro');
});

//Rota de Recuperação de Senha
Route::get('/recuperacao_senha', function(){
    return view('recuperacao_senha');
})->name('recuperacao_senha');

//Rota de telas do usuario para ofertas
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

//Rota de telas do usuario para ofertas
Route::prefix('extensao/demandas')->group(function(){
    Route::get('/minhas_demandas', function(){
        return view('demandas_membro/minhas_demandas');
    })->name('minhas_demandas');
    Route::get('/cadastrar_demandas', function(){
        return view('demandas_membro/cadastrar_demandas');
    })->name('cadastrar_demandas');
    Route::get('/sucesso_cadastro_demanda', function(){
        return view('demandas_membro/sucesso_cadastro_demanda');
    })->name('sucesso_cadastro_demanda');
});

//Rota de telas do usuario para demandas e ofertas
Route::prefix('extensao/disponivel')->group(function(){
    Route::get('/demandas_ofertas', function(){
        return view('demandas_ofertas_membro/demandas_ofertas');
    })->name('demandas_ofertas');
});

//Rota de telas do usuario para configuracoes
Route::prefix('extensao/configuracoes')->group(function(){
    Route::get('/configuracao_membro', function(){
        return view('configuracao_membro/configuracoes');
    })->name('configuracoes');
    Route::get('/ajuda_sistema', function(){
        return view('configuracao_membro/ajuda_sistema');
    })->name('ajuda_sistema');
    Route::get('/historico_demandas', function(){
        return view('configuracao_membro/historico_demandas');
    })->name('historico_demandas');
    Route::get('/historico_ofertas', function(){
        return view('configuracao_membro/historico_ofertas');
    })->name('historico_ofertas');
    Route::get('/enviar_feedback', function(){
        return view('configuracao_membro/enviar_feedback');
    })->name('enviar_feedback');
    Route::get('/sobre_nos', function(){
        return view('configuracao_membro/sobre_nos');
    })->name('sobre_nos');
});

//Rota de telas do usuario para perfil
Route::prefix('extensao/perfil')->group(function(){
    Route::get('/perfil_membro', function(){
        return view('perfil_membro/perfil');
    })->name('perfil');
});

//Rota de telas do usuario para sair
Route::prefix('extensao/sair')->group(function(){
    Route::get('/sair_membro', function(){
        return view('sair_membro/sair');
    })->name('sair');
});

//Rota de notificação contato notificacao
Route::prefix('extensao/contatos')->group(function(){
    Route::get('/todos_contatos', function(){
        return view('contatos_efetuados_membro/todos_contatos');
    })->name('todos_contatos');
    Route::get('/oferta_requisitada', function(){
        return view('contatos_efetuados_membro/oferta_requisitada');
    })->name('oferta_requisitada');
    Route::get('/demanda_atendida', function(){
        return view('contatos_efetuados_membro/demanda_atendida');
    })->name('demanda_atendida');
});