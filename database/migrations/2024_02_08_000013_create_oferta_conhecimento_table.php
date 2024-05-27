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
        Schema::create('OfertaConhecimento', function (Blueprint $table) {
            $table->id('id_oferta_conhecimento');
            $table->unsignedBigInteger('id_oferta');
            $table->enum('tempo_atuacao', ['MENOS_1_ANO', 'MAIS_1_ANO', 'MAIS_3_ANOS', 'MAIS_5_ANOS']);
            $table->string('link_lattes', 255)->nullable();
            $table->string('link_linkedin', 255)->nullable();
            
            $table->foreign('id_oferta')->references('id_oferta')->on('Oferta')->onDelete('cascade');
            $table->unique(['id_oferta_conhecimento', 'id_oferta']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('OfertaConhecimento');
    }
};
