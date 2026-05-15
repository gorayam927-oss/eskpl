@extends('layouts.app')

@section('title', 'Dashboard Dosen')

@section('content')

@php
    $namaDosen = $dosen->nama ?? $dosen->nama_lengkap ?? auth()->user()->name ?? '-';
    $nidnDosen = $dosen->nidn ?? '-';
    $prodiDosen = $dosen->prodi->nama_prodi ?? '-';
    $noHpDosen = $dosen->no_hp ?? '-';
    $alamatDosen = $dosen->alamat ?? '-';
@endphp

<div class="space-y-8">

    <div class="rounded-[2rem] bg-gradient-to-r from-indigo-500/30 to-cyan-500/30 border border-white/10 p-8 shadow-xl">
        <p class="text-cyan-300 font-bold uppercase tracking-widest text-sm">
            Dashboard Dosen
        </p>

        <h1 class="text-4xl font-black mt-3">
            Selamat Datang, {{ $namaDosen }}
        </h1>

        <p class="text-slate-300 mt-2">
            Kelola RPS, kontrak perkuliahan, dan capaian pembelajaran.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400">Total RPS</p>
            <h2 class="text-4xl font-black mt-3">{{ $totalRps ?? 0 }}</h2>
        </div>

        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400">Total Kontrak</p>
            <h2 class="text-4xl font-black mt-3">{{ $totalKontrak ?? 0 }}</h2>
        </div>

        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400">Kontrak Publish</p>
            <h2 class="text-4xl font-black mt-3">{{ $kontrakPublish ?? 0 }}</h2>
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
                        {{ strtoupper(substr($namaDosen, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h2 class="text-2xl font-black">Profil Dosen</h2>
                    <p class="text-cyan-300 text-sm font-bold uppercase">Dosen</p>
                </div>
            </div>

            <div class="space-y-4 text-slate-300">
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">Nama</p>
                    <p class="font-bold mt-1">{{ $namaDosen }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">NIDN</p>
                    <p class="font-bold mt-1">{{ $nidnDosen }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">Program Studi</p>
                    <p class="font-bold mt-1">{{ $prodiDosen }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">No HP</p>
                    <p class="font-bold mt-1">{{ $noHpDosen }}</p>
                </div>

                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <p class="text-slate-500 text-sm">Alamat</p>
                    <p class="font-bold mt-1">{{ $alamatDosen }}</p>
                </div>
            </div>

            <a href="{{ route('profile') }}"
               class="mt-6 inline-flex w-full justify-center px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
                Lengkapi Profil
            </a>
        </div>

        <div class="xl:col-span-2 rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black">Kontrak Terbaru</h2>
                    <p class="text-slate-400 text-sm mt-1">
                        Daftar kontrak perkuliahan terbaru yang dibuat.
                    </p>
                </div>

                <a href="{{ route('kontrak.index') }}"
                   class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-sm font-bold">
                    Lihat Semua
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recentKontrak as $item)
                    <div class="p-5 rounded-2xl bg-white/5 border border-white/10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="font-black text-lg">
                                {{ $item->judul }}
                            </h3>

                            <p class="text-sm text-slate-400 mt-1">
                                Mata Kuliah:
                                <span class="text-cyan-300">
                                    {{ $item->mataKuliah->nama_mk ?? '-' }}
                                </span>
                            </p>

                            <p class="text-xs text-slate-500 mt-2">
                                Dibuat: {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                            </p>
                        </div>

                        <span class="h-fit px-4 py-2 rounded-xl text-sm font-bold
                            {{ $item->status === 'publish'
                                ? 'bg-emerald-500/20 text-emerald-300'
                                : 'bg-amber-500/20 text-amber-300' }}">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                @empty
                    <div class="p-8 rounded-2xl bg-white/5 border border-dashed border-white/10 text-center">
                        <p class="text-slate-400">
                            Belum ada kontrak perkuliahan.
                        </p>

                        <a href="{{ route('kontrak.create') }}"
                           class="mt-4 inline-flex px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
                            + Buat Kontrak
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection