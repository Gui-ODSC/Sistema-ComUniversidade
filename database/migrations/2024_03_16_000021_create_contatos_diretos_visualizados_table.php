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
        Schema::create('ContatosDiretosVisualizados', function (Blueprint $table) {
            $table->id('id_contato_direto_visualizado');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_demanda')->nullable();
            $table->unsignedBigInteger('id_oferta')->nullable();

            $table->foreign('id_usuario')->references('id_usuario')->on('Usuario')->onDelete('restrict');
            $table->foreign('id_demanda')->references('id_demanda')->on('Demanda')->onDelete('restrict');
            $table->foreign('id_oferta')->references('id_oferta')->on('Oferta')->onDelete('restrict');
            $table->unique(['id_usuario', 'id_oferta'], 'uniqueOferta');
            $table->unique(['id_usuario', 'id_demanda'], 'uniqueDemanda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ContatosDiretosVisualizados');
    }
};
