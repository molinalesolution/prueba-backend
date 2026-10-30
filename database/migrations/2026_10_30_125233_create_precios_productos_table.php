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
        Schema::create('precios_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('currency_id');
            $table->decimal('price', 12, 2);
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('productos')
                ->onDelete('cascade');

            $table->foreign('currency_id')
                ->references('id')
                ->on('divisas')
                ->onDelete('cascade');

            $table->unique(['product_id', 'currency_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precios_productos');
    }
};
