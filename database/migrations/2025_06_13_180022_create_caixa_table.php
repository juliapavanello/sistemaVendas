<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('caixas', function (Blueprint $table) {
            $table->id();
            $table->string('fonte');
            $table->enum('tipo', ['Entrada', 'Saída']);
            $table->decimal('dinheiro', 8, 2)->default(0);
            $table->text('motivo')->nullable();
            $table->timestamps();
            
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('produto_id')->nullable();
            $table->unsignedBigInteger('venda_id')->nullable();

            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('produto_id')->references('id')->on('produtos');
            $table->foreign('venda_id')->references('id')->on('vendas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caixas');
    }
};
