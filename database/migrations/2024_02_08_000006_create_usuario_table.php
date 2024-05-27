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
            $table->unsignedBigInteger('id_cep');
            $table->string('nome', 255);
            $table->string('sobrenome', 255);
            $table->date('nascimento');
            $table->string('telefone', 16);
            $table->string('email', 255)->unique();
            $table->string('email_secundario', 255)->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->string('foto', 255)->nullable();
            $table->string('numero', 255);
            $table->string('complemento', 255)->nullable();
            $table->enum('tipo', ['MEMBRO', 'ALUNO', 'PROFESSOR']);
            $table->enum('tipo_pessoa', ['FISICA', 'JURIDICA']);
            $table->string('instituicao', 100)->nullable();

            $table->foreign('id_cep')->references('id_cep')->on('Cep');

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
