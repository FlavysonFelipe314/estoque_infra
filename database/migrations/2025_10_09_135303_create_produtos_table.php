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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('nome');
            $table->string('categoria');
            $table->string('unidade');
            $table->integer('estoque_atual');
            $table->integer('estoque_min');
            $table->integer('estoque_max');
            $table->string('status');
            $table->decimal('price',10,2);
            $table->foreignId('fornecedor_id')
            ->constrained()
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->foreignId('user_id')
            ->constrained()
            ->onDelete('CASCADE')
            ->onUpdate('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
