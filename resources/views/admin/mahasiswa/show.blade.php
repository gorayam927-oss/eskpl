@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <h1 class="text-3xl font-black text-white">Detail Mahasiswa</h1>

    <div class="rounded-3xl bg-white/5 border border-white/10 p-8 shadow-2xl space-y-5">
        <div>
            <p class="text-slate-400 text-sm">Nama Lengkap</p>
            <p class="text-white font-bold">{{ $mahasiswa->nama_lengkap ?? $mahasiswa->user->name ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">NIM</p>
            <p class="text-white font-bold">{{ $mahasiswa->nim ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Program Studi</p>
            <p class="text-white font-bold">{{ $mahasiswa->prodi->nama_prodi ?? $mahasiswa->prodi->nama ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Email</p>
            <p class="text-white font-bold">{{ $mahasiswa->user->email ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">No HP</p>
            <p class="text-white font-bold">{{ $mahasiswa->no_hp ?? '-' }}</p>
        </div>

        <div>
            <p class="text-slate-400 text-sm">Alamat</p>
            <p class="text-white font-bold">{{ $mahasiswa->alamat ?? '-' }}</p>
        </div>

        <div class="flex gap-3 pt-4">
            <a href="{{ route('admin.mahasiswa.index') }}" class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                ← Kembali
            </a>

            <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="px-5 py-3 rounded-2xl bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 font-bold">
                Edit
            </a>
        </div>
    </div>
</div>
@endsection