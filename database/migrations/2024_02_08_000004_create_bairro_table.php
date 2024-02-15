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
        Schema::create('Bairro', function (Blueprint $table) {
            $table->id('id_bairro');
            $table->unsignedBigInteger('id_cidade');
            $table->string('nome');
            
            $table->foreign('id_cidade')->references('id_cidade')->on('Cidade')->onDelete('cascade');
            $table->unique(['id_cidade', 'nome']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('Bairro');
    }
};
