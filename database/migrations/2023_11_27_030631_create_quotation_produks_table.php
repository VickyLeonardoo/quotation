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
        Schema::create('quotation_produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->foreignId('produk_id')->references('id')->on('produks');
            $table->integer('quantity');
            $table->decimal('harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_produks');
    }
};
