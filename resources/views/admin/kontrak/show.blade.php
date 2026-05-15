@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-black text-white">Detail Kontrak Perkuliahan</h1>
        <p class="text-slate-400 mt-1">Informasi lengkap kontrak perkuliahan</p>
    </div>

    <!-- Card -->
    <div class="rounded-3xl bg-white/5 border border-white/10 p-6 lg:p-8 shadow-2xl">

        <!-- Judul -->
        <h2 class="text-2xl font-black text-white mb-4">
            {{ $kontrak->judul_kontrak }}
        </h2>

        <!-- Info utama -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">

            <div>
                <p class="text-slate-400 text-sm">Dosen</p>
                <p class="font-bold text-white">
                    {{ $kontrak->dosen->nama ?? $kontrak->dosen->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">Mata Kuliah</p>
                <p class="font-bold text-white">
                    {{ $kontrak->mataKuliah->nama_mata_kuliah 
                        ?? $kontrak->mataKuliah->nama 
                        ?? $kontrak->mataKuliah->kode_mk 
                        ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">RPS</p>
                <p class="font-bold text-white">
                    {{ $kontrak->rps->judul ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">Status</p>
                @if($kontrak->status == 'publish')
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                        Publish
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-xs font-bold">
                        Draft
                    </span>
                @endif
            </div>

        </div>

        <!-- Divider -->
        <div class="border-t border-white/10 my-6"></div>

        <!-- Detail Section -->
        <div class="space-y-6">

            <div>
                <h4 class="font-bold text-white mb-1">Deskripsi Mata Kuliah</h4>
                <p class="text-slate-300">{{ $kontrak->deskripsi_mata_kuliah ?? '-' }}</p>
            </div>

            <div>
                <h4 class="font-bold text-white mb-1">Jadwal Kuliah</h4>
                <p class="text-slate-300">{{ $kontrak->jadwal ?? '-' }}</p>
            </div>

            <div>
                <h4 class="font-bold text-white mb-1">Metode Pembelajaran</h4>
                <p class="text-slate-300">{{ $kontrak->metode_pembelajaran ?? '-' }}</p>
            </div>

            <div>
                <h4 class="font-bold text-white mb-1">Aturan Kehadiran</h4>
                <p class="text-slate-300">{{ $kontrak->aturan_kehadiran ?? '-' }}</p>
            </div>

            <div>
                <h4 class="font-bold text-white mb-1">Sistem Penilaian</h4>
                <p class="text-slate-300">{{ $kontrak->sistem_penilaian ?? '-' }}</p>
            </div>

            <div>
                <h4 class="font-bold text-white mb-1">Referensi Belajar</h4>
                <p class="text-slate-300">{{ $kontrak->referensi_belajar ?? '-' }}</p>
            </div>

            <div>
                <h4 class="font-bold text-white mb-1">CPMK</h4>
                <p class="text-slate-300">{{ $kontrak->cpmk ?? '-' }}</p>
            </div>

            <div>
                <h4 class="font-bold text-white mb-1">CPL</h4>
                <p class="text-slate-300">{{ $kontrak->cpl ?? '-' }}</p>
            </div>

        </div>

        <!-- Divider -->
        <div class="border-t border-white/10 my-6"></div>

        <!-- Button -->
        <div class="flex gap-3">
            <a href="{{ route('kontrak.index') }}"
               class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                ← Kembali
            </a>

            <a href="{{ route('kontrak.edit', $kontrak->id) }}"
               class="px-5 py-3 rounded-2xl bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 font-bold">
                Edit
            </a>
        </div>

    </div>
</div>
@endsection