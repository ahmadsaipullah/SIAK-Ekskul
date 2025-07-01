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
        Schema::create('pertemuan_eskuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('eskul_id');
            $table->date('tanggal');
            $table->string('materi');
            $table->timestamps();

            $table->foreign('eskul_id')->references('id')->on('eskuls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertemuan_eskuls');
    }
};
