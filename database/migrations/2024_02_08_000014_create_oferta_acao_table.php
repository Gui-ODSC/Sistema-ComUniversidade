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
        Schema::create('OfertaAcao', function (Blueprint $table) {
            $table->id('id_oferta_acao');
            $table->unsignedBigInteger('id_oferta');
            $table->unsignedBigInteger('id_tipo_acao');
            $table->unsignedBigInteger('id_publico_alvo');
            $table->enum('status_registro', ['NAO_REGISTRADA', 'REGISTRADA']);
            $table->enum('duracao', ['DIAS', 'SEMANAS', 'MESES', 'ANOS', 'INDEFINIDO']);
            $table->enum('regime', ['PRESENCIAL', 'ONLINE']);
            $table->timestamp('data_limite')->nullable();

            $table->foreign('id_oferta')->references('id_oferta')->on('Oferta')->onDelete('cascade');
            $table->foreign('id_tipo_acao')->references('id_tipo_acao')->on('TipoAcao')->onDelete('restrict');
            $table->foreign('id_publico_alvo')->references('id_publico_alvo')->on('PublicoAlvo')->onDelete('restrict');
            $table->unique(['id_oferta_acao', 'id_oferta']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('OfertaAcao');
    }
};
