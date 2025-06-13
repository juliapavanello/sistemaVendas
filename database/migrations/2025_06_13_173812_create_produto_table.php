<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao');
            $table->decimal('preco', 8, 2);
            $table->decimal('custo', 8, 2);
            $table->integer('quantidade')->default(0);
            $table->string('unidade');
            $table->integer('avisoLeve')->default(0);
            $table->integer('avisoGrave')->default(0);
            $table->boolean('descontarCaixa')->default(false);
            $table->boolean('descontarEstoque')->default(false);
            $table->boolean('paraVenda')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
