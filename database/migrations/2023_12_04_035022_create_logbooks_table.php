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
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->integer('persentase');
            $table->date('tglPekerjaan');
            $table->text('deskripsi');
            $table->foreignId('user_id')->references('id')->on('users')->comment('Created by?');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};
