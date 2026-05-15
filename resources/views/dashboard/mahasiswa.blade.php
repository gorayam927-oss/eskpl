@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')

@php
    $namaMahasiswa = $mahasiswa->nama ?? $mahasiswa->nama_lengkap ?? auth()->user()->name ?? '-';
    $nimMahasiswa = $mahasiswa->nim ?? '-';
    $prodiMahasiswa = $mahasiswa->prodi->nama_prodi ?? '-';
    $angkatanMahasiswa = $mahasiswa->angkatan ?? '-';
    $noHpMahasiswa = $mahasiswa->no_hp ?? '-';
    $alamatMahasiswa = $mahasiswa->alamat ?? '-';
@endphp

<div class="space-y-8">

    <div class="rounded-[2rem] bg-gradient-to-r from-indigo-500/30 to-cyan-500/30 border border-white/10 p-8 shadow-xl">
        <p class="text-cyan-300 font-bold uppercase tracking-widest text-sm">
            Dashboard Mahasiswa
        </p>

        <h1 class="text-4xl font-black mt-3">
            Halo, {{ $namaMahasiswa }}
        </h1>

        <p class="text-slate-300 mt-2">
            Pantau kontrak, verifikasi, dan capaian pembelajaran kamu.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400">Verifikasi Kontrak</p>
            <h2 class="text-4xl font-black mt-3">{{ $totalVerifikasi ?? 0 }}</h2>
        </div>

        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400">Tracking Capaian</p>
            <h2 class="text-4xl font-black mt-3">{{ $totalTracking ?? 0 }}</h2>
        </div>

        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400">Progress Capaian</p>
            <h2 class="text-4xl font-black mt-3">{{ $progressCapaian ?? 0 }}%</h2>

            <div class="mt-5 h-3 bg-slate-800 rounded-full overflow-hidden">
                <div class="h-full bg-cyan-500 rounded-full"
                     style="width: {{ min($progressCapaian ?? 0, 100) }}%">
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <div class="flex items-center gap-4 mb-6">
                @if(auth()->user()->foto)
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                         class="w-16 h-16 rounded-full object-cover border-2 border-cyan-400">
                @else
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-400 flex items-center justify-center text-2xl font-black">
                        {{ strtoupper(substr($namaMahasiswa, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h2 class="text-2xl font-black">Profil Mahasiswa</h2>
                    <p class="text-cyan-300 text-sm font-bold uppercase">Mahasiswa</p>
                </div>
            </div>

            <div class="space-y-4 text-slate-300">
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">Nama</p>
                    <p class="font-bold mt-1">{{ $namaMahasiswa }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">NIM</p>
                    <p class="font-bold mt-1">{{ $nimMahasiswa }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">Program Studi</p>
                    <p class="font-bold mt-1">{{ $prodiMahasiswa }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">Angkatan</p>
                    <p class="font-bold mt-1">{{ $angkatanMahasiswa }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">No HP</p>
                    <p class="font-bold mt-1">{{ $noHpMahasiswa }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">Alamat</p>
                    <p class="font-bold mt-1">{{ $alamatMahasiswa }}</p>
                </div>
            </div>

            <a href="{{ route('profile') }}"
               class="mt-6 inline-flex w-full justify-center px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
                Lengkapi Profil
            </a>
        </div>

        <div class="xl:col-span-2 rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-black">Capaian Terbaru</h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Riwayat capaian pembelajaran terbaru.
                    </p>
                </div>

                <a href="{{ route('tracking.index') }}"
                   class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-sm font-bold">
                    Lihat Semua
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recentTracking as $item)
                    <div class="p-5 rounded-2xl bg-white/5 border border-white/10">
                        <div class="flex justify-between gap-4 mb-3">
                            <div>
                                <h3 class="font-black text-lg">
                                    {{ $item->capaian }}
                                </h3>

                                <p class="text-sm text-slate-400">
                                    Pertemuan {{ $item->pertemuan }}
                                </p>

                                <p class="text-xs text-slate-500 mt-2">
                                    Kontrak:
                                    {{ $item->kontrak->judul ?? '-' }}
                                </p>
                            </div>

                            <span class="text-cyan-300 font-black text-xl">
                                {{ $item->persentase }}%
                            </span>
                        </div>

                        <div class="h-3 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full bg-cyan-500 rounded-full"
                                 style="width: {{ min($item->persentase, 100) }}%">
                            </div>
                        </div>

                        @if(!empty($item->catatan))
                            <p class="text-sm text-slate-400 mt-3">
                                Catatan: {{ $item->catatan }}
                            </p>
                        @endif
                    </div>
                @empty
                    <div class="p-8 rounded-2xl bg-white/5 border border-dashed border-white/10 text-center">
                        <p class="text-slate-400">
                            Belum ada data capaian.
                        </p>

                        <a href="{{ route('tracking.index') }}"
                           class="mt-4 inline-flex px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
                            Lihat Tracking
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection