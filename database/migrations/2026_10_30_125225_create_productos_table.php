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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->unsignedBigInteger('currency_id');
            $table->decimal('tax_cost', 12, 2)->default(0);
            $table->decimal('manufacturing_cost', 12, 2)->default(0);
            $table->timestamps();

            $table->foreign('currency_id')
                ->references('id')
                ->on('divisas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
