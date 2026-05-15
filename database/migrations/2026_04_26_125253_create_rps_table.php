<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('rps')) {
            Schema::create('rps', function (Blueprint $table) {
                $table->id();
                $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnDelete();
                $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
                $table->string('judul');
                $table->string('file_rps');
                $table->enum('status', ['draft', 'diajukan', 'disetujui', 'ditolak'])->default('draft');
                $table->text('catatan')->nullable();
                $table->timestamps();
            });
        }
    }
    

    public function down(): void
    {
        Schema::dropIfExists('rps');
    }
};