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
        Schema::create('Cep', function (Blueprint $table) {
            $table->id('id_cep');
            $table->string('cep', 8);
            $table->string('logradouro', 255)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('complemento', 255)->nullable();
            $table->unsignedBigInteger('id_cidade');
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_cidade')->references('id_cidade')->on('Cidade');
            $table->foreign('id_estado')->references('id_estado')->on('Estado');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('Cep');
    }
};
