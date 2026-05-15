<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mata_kuliah', function (Blueprint $table) {
            $table->id();

            $table->foreignId('prodi_id')
                ->nullable()
                ->constrained('prodi')
                ->nullOnDelete();

            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->integer('sks')->default(2);
            $table->integer('semester')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};