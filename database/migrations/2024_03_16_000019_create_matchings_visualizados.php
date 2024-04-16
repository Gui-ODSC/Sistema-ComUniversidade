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
        Schema::create('MatchingsVisualizados', function (Blueprint $table) {
            $table->id('id_matching_visualizado');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_demanda');
            $table->unsignedBigInteger('id_oferta');
            $table->boolean('ativo')->default(true);
            
            $table->foreign('id_usuario')->references('id_usuario')->on('Usuario')->onDelete('restrict');
            $table->foreign('id_demanda')->references('id_demanda')->on('Demanda')->onDelete('cascade');
            $table->foreign('id_oferta')->references('id_oferta')->on('Oferta')->onDelete('cascade');
            $table->unique(['id_usuario', 'id_demanda', 'id_oferta'], 'uniqueMatchingVisualizado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('MatchingsVisualizados');
    }

};
