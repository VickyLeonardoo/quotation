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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')->references('id')->on('perusahaans');
            $table->string('quotationNo');
            $table->date('tglQuotation');
            $table->decimal('total', 15, 2)->nullable();
            $table->enum('status', [0, 1, 2, 3, 4, 5])->default('0')->comment('0 = Draft, 1 = Pending,2 = Accepted, 3 = Confirmed, 4 = Selesai, 5 = Ditolax');
            $table->string('garansi');
            $table->boolean('is_invoice')->default(false);
            $table->boolean('is_email')->default(false);
            $table->boolean('is_archive')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
