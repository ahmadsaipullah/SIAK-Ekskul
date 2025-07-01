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
        Schema::create('eskuls', function (Blueprint $table) {
                $table->id();
                $table->string('nama_eskul');
                $table->text('deskripsi')->nullable();
                $table->unsignedBigInteger('pelatih_id');
                $table->string('tahun_ajaran');
                $table->string('no_hp')->nullable(); // otomatis diisi dari pelatih
                $table->string('logo')->nullable(); // logo eskul
                $table->integer('jumlah_pertemuan')->default(0);
                $table->timestamps();

    $table->foreign('pelatih_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eskuls');
    }
};
