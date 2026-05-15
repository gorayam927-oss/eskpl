<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracking_capaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kontrak_id');
            $table->unsignedBigInteger('pertemuan_id');
            $table->unsignedBigInteger('cpmk_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->integer('nilai')->default(0);
            $table->integer('persentase')->default(0);
            $table->enum('status', ['belum', 'proses', 'tercapai'])->default('belum');
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->unique(['kontrak_id', 'pertemuan_id', 'cpmk_id', 'mahasiswa_id'], 'tracking_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking_capaian');
    }
};