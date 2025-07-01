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
        Schema::create('jadwal_eskuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eskul_id');
            $table->string('hari'); // Senin - Minggu
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('lokasi');
            $table->timestamps();

            $table->foreign('eskul_id')->references('id')->on('eskuls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_eskuls');
    }
};
