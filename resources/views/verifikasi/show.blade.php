@extends('layouts.app', ['title' => 'Detail Verifikasi', 'pageTitle' => 'Detail Verifikasi'])

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div>
        <h1 class="text-3xl font-black text-white">{{ $kontrak->judul_kontrak }}</h1>
        <p class="text-slate-400 mt-1">Baca kontrak dengan teliti sebelum menyetujui.</p>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 p-8 shadow-2xl space-y-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <p class="text-slate-400 text-sm">Mata Kuliah</p>
                <p class="text-white font-bold">
                    {{ $kontrak->mataKuliah->nama_mk
                        ?? $kontrak->mataKuliah->nama_mata_kuliah
                        ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">Dosen</p>
                <p class="text-white font-bold">
                    {{ $kontrak->dosen->nama_lengkap
                        ?? $kontrak->dosen->user->name
                        ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">RPS</p>
                <p class="text-white font-bold">
                    {{ $kontrak->rps->judul ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">Jadwal</p>
                <p class="text-white font-bold">
                    {{ $kontrak->jadwal ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">Status Verifikasi</p>
                @if($verifikasi->status === 'disetujui')
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                        Disetujui
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold">
                        Sudah Dibaca
                    </span>
                @endif
            </div>
        </div>

        <div class="border-t border-white/10"></div>

        @foreach([
            'deskripsi_mata_kuliah' => 'Deskripsi Mata Kuliah',
            'metode_pembelajaran' => 'Metode Pembelajaran',
            'aturan_kehadiran' => 'Aturan Kehadiran',
            'sistem_penilaian' => 'Sistem Penilaian',
            'referensi_belajar' => 'Referensi Belajar',
            'cpmk' => 'CPMK',
            'cpl' => 'CPL',
        ] as $field => $label)
            <div>
                <p class="text-slate-400 text-sm">{{ $label }}</p>
                <p class="text-white font-semibold whitespace-pre-line">
                    {{ $kontrak->$field ?? '-' }}
                </p>
            </div>
        @endforeach

        <div class="border-t border-white/10"></div>

        @if($verifikasi->status !== 'disetujui')
            <form action="{{ route('verifikasi.setujui', $kontrak->id) }}" method="POST" class="space-y-4">
                @csrf

                <label class="flex items-start gap-3 text-slate-300">
                    <input type="checkbox" name="persetujuan" value="1" required class="mt-1">
                    <span>Saya telah membaca dan menyetujui kontrak perkuliahan ini.</span>
                </label>

                <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
                    Setujui Kontrak
                </button>
            </form>
        @else
            <div class="rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 p-4 font-bold">
                Kamu sudah menyetujui kontrak ini pada {{ $verifikasi->waktu_verifikasi }}.
            </div>
        @endif

        <a href="{{ route('verifikasi.index') }}"
           class="inline-block px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
            ← Kembali
        </a>
    </div>
</div>
@endsection