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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->string('invoiceNo');
            $table->date('tglInvoice');
            $table->date('payment_due');
            $table->enum('status', [0, 1, 2, 3, 4, 5])->default('0')->comment('0 = Draft, 1 = Pending,2 = Accepted, 3 = Confirmed, 4 = Selesai, 5 = Ditolax');
            $table->boolean('is_archive')->default(false);
            $table->boolean('is_delivery')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
