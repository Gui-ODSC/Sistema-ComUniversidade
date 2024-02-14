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
        Schema::create('Endereco', function (Blueprint $table) {
            $table->id('id_endereco');
            $table->unsignedBigInteger('id_bairro');
            $table->string('rua');
            $table->integer('numero');
            $table->string('complemento');
            
            $table->foreign('id_bairro')->references('id_bairro')->on('Bairro')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Endereco');
    }
};
