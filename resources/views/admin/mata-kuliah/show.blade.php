@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <h1 class="text-3xl font-black text-white">Detail Mata Kuliah</h1>

    <div class="rounded-3xl bg-white/5 border border-white/10 p-8 shadow-2xl space-y-5">
        <div>
            <p class="text-slate-400 text-sm">Kode Mata Kuliah</p>
            <p class="text-white font-bold">{{ $mataKuliah->kode_mk ?? $mataKuliah->kode_mata_kuliah ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Nama Mata Kuliah</p>
            <p class="text-white font-bold">{{ $mataKuliah->nama_mata_kuliah ?? $mataKuliah->nama ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">SKS</p>
            <p class="text-white font-bold">{{ $mataKuliah->sks ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Semester</p>
            <p class="text-white font-bold">{{ $mataKuliah->semester ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Program Studi</p>
            <p class="text-white font-bold">{{ $mataKuliah->prodi->nama_prodi ?? $mataKuliah->prodi->nama ?? '-' }}</p>
        </div>

        <div class="flex gap-3 pt-4">
            <a href="{{ route('admin.mata-kuliah.index') }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                ← Kembali
            </a>

            <a href="{{ route('admin.mata-kuliah.edit', $mataKuliah->id) }}" class="px-5 py-3 rounded-2xl bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 font-bold">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection