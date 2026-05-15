@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <h1 class="text-3xl font-black text-white">Detail Kelas</h1>

    <div class="rounded-3xl bg-white/5 border border-white/10 p-8 shadow-2xl space-y-5">
        <div>
            <p class="text-slate-400 text-sm">Nama Kelas</p>
            <p class="text-white font-bold">{{ $kelas->nama_kelas ?? $kelas->nama ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Mata Kuliah</p>
            <p class="text-white font-bold">
                {{ $kelas->mataKuliah->nama_mata_kuliah ?? $kelas->mataKuliah->nama ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Dosen</p>
            <p class="text-white font-bold">
                {{ $kelas->dosen->nama_lengkap ?? $kelas->dosen->user->name ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Semester</p>
            <p class="text-white font-bold">{{ $kelas->semester ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Tahun Akademik</p>
            <p class="text-white font-bold">{{ $kelas->tahun_akademik ?? '-' }}</p>
        </div>

        <div class="flex gap-3 pt-4">
            <a href="{{ route('admin.kelas.index') }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                ← Kembali
            </a>

            <a href="{{ route('admin.kelas.edit', $kelas->id) }}" class="px-5 py-3 rounded-2xl bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 font-bold">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection