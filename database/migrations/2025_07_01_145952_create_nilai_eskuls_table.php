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
        Schema::create('nilai_eskuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // siswa
            $table->unsignedBigInteger('eskul_id');
            $table->integer('nilai')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('eskul_id')->references('id')->on('eskuls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_eskuls');
    }
};
