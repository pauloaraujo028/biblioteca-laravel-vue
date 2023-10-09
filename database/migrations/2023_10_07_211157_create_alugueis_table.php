<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alugueis', function (Blueprint $table) {
            $table->id('aluguel_id');
            $table->unsignedBigInteger('livro_id');
            $table->unsignedBigInteger('usuario_id');
            $table->dateTime('dt_aluguel_ini');
            $table->dateTime('dt_aluguel_fim');
            $table->timestamp('dt_inclusao')->default(now());
            $table->timestamp('dt_alteracao')->default(now());

            $table->foreign('livro_id')->references('livro_id')->on('livros');
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alugueis');
    }
};
