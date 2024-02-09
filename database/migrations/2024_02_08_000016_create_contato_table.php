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
        Schema::create('Contato', function (Blueprint $table) {
            $table->id('id_contato');
            $table->unsignedBigInteger('id_usuario_origem');
            $table->unsignedBigInteger('id_usuario_destino');
            $table->unsignedBigInteger('id_oferta');
            $table->unsignedBigInteger('id_demanda');
            
            $table->foreign('id_usuario_origem')->references('id_usuario')->on('Usuario')->onDelete('cascade');
            $table->foreign('id_usuario_destino')->references('id_usuario')->on('Usuario')->onDelete('cascade');
            $table->foreign('id_oferta')->references('id_oferta')->on('Oferta')->onDelete('cascade');
            $table->foreign('id_demanda')->references('id_demanda')->on('Demanda')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Contato');
    }
};
