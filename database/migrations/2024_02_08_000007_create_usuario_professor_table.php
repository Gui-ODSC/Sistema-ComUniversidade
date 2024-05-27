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
        Schema::create('UsuarioProfessor', function (Blueprint $table) {
            $table->id('id_usuario_professor');
            $table->unsignedBigInteger('id_usuario');
            $table->string('link_curriculo', 255)->nullable();
            $table->integer('numero_registro');
            
            $table->foreign('id_usuario')->references('id_usuario')->on('Usuario')->onDelete('restrict');
            $table->unique(['id_usuario_professor', 'id_usuario']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UsuarioProfessor');
    }
};
