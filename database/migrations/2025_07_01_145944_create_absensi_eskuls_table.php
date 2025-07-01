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
        Schema::create('absensi_eskuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // siswa
            $table->unsignedBigInteger('pertemuan_id');
            $table->enum('status', ['hadir', 'izin', 'alfa'])->default('alfa');
            $table->string('lokasi')->nullable(); // ex: "Tangerang"
            $table->string('foto')->nullable(); // path foto absensi
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pertemuan_id')->references('id')->on('pertemuan_eskuls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_eskuls');
    }
};
