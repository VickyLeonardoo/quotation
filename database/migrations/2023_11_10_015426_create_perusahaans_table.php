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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('c_nama');
            $table->string('c_alamat');
            $table->string('c_jalan1');
            $table->string('c_jalan2');
            $table->string('c_pos');
            $table->string('kode');
            $table->string('nama');
            $table->string('email');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kodePos')->nullable();
            $table->string('alamat');
            $table->string('jalan1')->nullable();
            $table->string('jalan2')->nullable();
            $table->string('jalan3')->nullable();
            $table->string('noTelp')->nullable();
            $table->string('fax')->nullable();
            $table->string('slug')->unique();
            $table->string('pic');
            $table->string('pic2');
            $table->string('pic3');
            $table->string('pic4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
