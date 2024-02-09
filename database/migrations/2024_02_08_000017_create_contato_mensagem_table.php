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
        Schema::create('ContatoMensagem', function (Blueprint $table) {
            $table->id('id_contato_mensagem');
            $table->unsignedBigInteger('id_contato');
            $table->unsignedBigInteger('id_usuario_origem');
            $table->unsignedBigInteger('id_usuario_destino');
            $table->string('mensagem');

            $table->foreign('id_contato')->references('id_contato')->on('Contato')->onDelete('cascade');
            $table->foreign('id_usuario_origem')->references('id_usuario')->on('Usuario')->onDelete('cascade');
            $table->foreign('id_usuario_destino')->references('id_usuario')->on('Usuario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ContatoMensagem');
    }
};
