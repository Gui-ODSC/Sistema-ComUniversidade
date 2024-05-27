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
        Schema::create('Oferta', function (Blueprint $table) {
            $table->id('id_oferta');
            $table->unsignedBigInteger('id_usuario_professor');
            $table->unsignedBigInteger('id_area_conhecimento');
            $table->string('titulo', 255);
            $table->longText('descricao');
            $table->enum('tipo', ['ACAO', 'CONHECIMENTO']);

            $table->foreign('id_usuario_professor')->references('id_usuario_professor')->on('UsuarioProfessor')->onDelete('restrict');
            $table->foreign('id_area_conhecimento')->references('id_area_conhecimento')->on('AreaConhecimento')->onDelete('restrict');
            $table->unique(['id_usuario_professor', 'titulo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Oferta');
    }
};
