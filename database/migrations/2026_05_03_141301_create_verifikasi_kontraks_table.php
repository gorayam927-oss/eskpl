<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('verifikasi_kontrak', function (Blueprint $table) {
            $table->id();

            $table->foreignId('kontrak_id')
                  ->constrained('kontrak_perkuliahans')
                  ->cascadeOnDelete();

            $table->foreignId('mahasiswa_id')
                  ->constrained('mahasiswa')
                  ->cascadeOnDelete();

            $table->enum('status', [
                'belum_dibaca',
                'sudah_dibaca',
                'disetujui'
            ])->default('belum_dibaca');

            $table->timestamp('waktu_baca')->nullable();
            $table->timestamp('waktu_verifikasi')->nullable();

            $table->timestamps();

            $table->unique(['kontrak_id', 'mahasiswa_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('verifikasi_kontrak');
    }
};