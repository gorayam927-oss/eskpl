<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontrak_perkuliahans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rps_id')->nullable();
            $table->unsignedBigInteger('dosen_id')->nullable();
            $table->unsignedBigInteger('mata_kuliah_id')->nullable();

            $table->string('judul_kontrak');
            $table->text('deskripsi_mata_kuliah')->nullable();
            $table->string('jadwal')->nullable();
            $table->text('metode_pembelajaran')->nullable();
            $table->text('aturan_kehadiran')->nullable();
            $table->text('sistem_penilaian')->nullable();
            $table->text('referensi_belajar')->nullable();
            $table->text('cpmk')->nullable();
            $table->text('cpl')->nullable();

            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontrak_perkuliahans');
    }
};