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
        Schema::create('Estado', function (Blueprint $table) {
            $table->id('id_estado');
            $table->string('nome', 255)->nullable();
            $table->string('uf', 255)->nullable();

            $table->timestamps();
            $table->unique('nome');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Estado');
    }
};
