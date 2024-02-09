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
            $table->integer('tempo_atuacao')->unsigned;
            $table->string('link_lattes');
            $table->string('link_linkedin');
            
            $table->foreign('id_oferta')->references('id_oferta')->on('Oferta')->onDelete('cascade');
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
