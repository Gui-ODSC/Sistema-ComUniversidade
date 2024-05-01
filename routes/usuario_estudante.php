<?php 

use App\Http\Controllers\EstudanteControllers\CadastroEstudanteController;
use App\Http\Controllers\EstudanteControllers\ContatoRealizadoEstudanteController;
use App\Http\Controllers\EstudanteControllers\TodasOfertasEstudanteController;
use Illuminate\Support\Facades\Route;

Route::prefix('estudante')->group(function(){

    //Rota de cadastro para membros da sociedade 
    Route::prefix('/cadastro_estudante')->controller(CadastroEstudanteController::class)->group( function(){
        Route::get('/', 'indexCreateEstudante')->name('cadastro_estudante_index');
        Route::post('/', 'createEstudante')->name('cadastro_create_estudante');
    });  

    Route::prefix('/todas-ofertas-acao')->controller(TodasOfertasEstudanteController::class)->group(function(){
        Route::get('/', 'listaOfertas')->name('lista_todas_ofertas_estudante');
        Route::prefix('/{ofertaId}')->group(function (){
            Route::post('/', 'createContato')->name('contato_direto_store_estudante');
            Route::post('/visualizar', 'contato_direto_status_visualizar')->name('contato_direto_visualizar_estudante');
            Route::post('/remover', 'contatos_diretos_remover')->name('contato_direto_remover_estudante');
        })->middleware('auth');
    })->middleware('auth');

    Route::prefix('/contatos_realizados')->controller(ContatoRealizadoEstudanteController::class)->group(function() {
        Route::get('/', 'listaContatosRealizados')->name('lista_contatos_realizados_estudante');
    })->middleware('auth');

    Route::prefix('extensao/configuracoes_estudante')->group(function(){
        Route::get('/configuracao', function(){
            return view('usuarioEstudante/configuracao/configuracoes_estudante');
        })->name('configuracoes_estudante');
        Route::get('/ajuda_sistema', function(){
            return view('usuarioEstudante/configuracao/ajuda_sistema');
        })->name('ajuda_sistema_estudante');
        Route::get('/enviar_feedback', function(){
            return view('usuarioEstudante/configuracao/enviar_feedback');
        })->name('enviar_feedback_estudante');
        Route::get('/sobre_nos', function(){
            return view('usuarioEstudante/configuracao/sobre_nos');
        })->name('sobre_nos_estudante');
    })->middleware('auth');
});



