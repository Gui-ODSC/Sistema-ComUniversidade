<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Demanda', function (Blueprint $table) {
            $table->id('id_demanda');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_publico_alvo');
            $table->unsignedBigInteger('id_area_conhecimento');
            $table->string('titulo');
            $table->string('descricao');
            $table->integer('pessoas_afetadas')->unsigned;
            $table->enum('duracao', ['DIAS', 'SEMANAS', 'ANOS', 'INDEFINIDO']);
            $table->enum('nivel_prioridade', ['BAIXO', 'MEDIO', 'ALTO']);
            $table->string('instituicao_setor');

            $table->foreign('id_usuario')->references('id_usuario')->on('Usuario')->onDelete('cascade');
            $table->foreign('id_publico_alvo')->references('id_publico_alvo')->on('PublicoAlvo')->onDelete('cascade');
            $table->foreign('id_area_conhecimento')->references('id_area_conhecimento')->on('AreaConhecimento')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Demanda');
    }
};
