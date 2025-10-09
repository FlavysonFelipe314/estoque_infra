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
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreignId('produto_id')
            ->constrained()
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->string('urgencia');
            $table->string('justificativa');
            $table->integer('quantidade');
            $table->string('status')->default('pendente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};
