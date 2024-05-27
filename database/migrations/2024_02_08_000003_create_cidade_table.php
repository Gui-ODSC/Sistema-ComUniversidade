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
        Schema::create('Cidade', function (Blueprint $table) {
            $table->id('id_cidade');
            $table->string('nome', 255)->nullable();
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_estado')->references('id_estado')->on('Estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Cidade');
    }
};
