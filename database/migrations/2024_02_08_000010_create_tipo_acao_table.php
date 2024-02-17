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
        Schema::create('TipoAcao', function (Blueprint $table) {
            $table->id('id_tipo_acao');
            $table->string('nome_modalidade');

            $table->unique(['id_tipo_acao', 'nome_modalidade']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('TipoAcao');
    }
};