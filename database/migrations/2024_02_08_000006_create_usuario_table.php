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
        Schema::create('Usuario', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->unsignedBigInteger('id_endereco');
            $table->string('nome');
            $table->string('sobrenome');
            $table->date('nascimento');
            $table->string('telefone', 16);
            $table->string('email_primario')->unique();
            $table->string('email_secundario')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('senha');
            $table->string('remember_token', 100)->nullable();
            $table->string('foto');
            $table->enum('tipo', ['MEMBRO', 'ALUNO', 'PROFESSOR']);
            
            $table->foreign('id_endereco')->references('id_endereco')->on('Endereco')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Usuario');
    }
};
