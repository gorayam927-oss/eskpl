@extends('layouts.app', ['title' => 'Monitoring Verifikasi', 'pageTitle' => 'Monitoring Verifikasi'])

@section('content')
@php
    $total = $verifikasi->count();
    $disetujui = $verifikasi->where('status', 'disetujui')->count();
    $sudahDibaca = $verifikasi->where('status', 'sudah_dibaca')->count();
    $persen = $total > 0 ? round(($disetujui / $total) * 100) : 0;
@endphp

<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-black text-white">Monitoring Verifikasi</h1>
        <p class="text-slate-400 mt-1">{{ $kontrak->judul_kontrak }}</p>
    </div>

    <div class="grid md:grid-cols-3 gap-4">
        <div class="rounded-3xl bg-white/5 border border-white/10 p-6 shadow-xl">
            <p class="text-slate-400 text-sm">Total Verifikasi</p>
            <h2 class="text-4xl font-black mt-2">{{ $total }}</h2>
        </div>

        <div class="rounded-3xl bg-emerald-500/10 border border-emerald-500/20 p-6 shadow-xl">
            <p class="text-emerald-300 text-sm">Sudah Disetujui</p>
            <h2 class="text-4xl font-black mt-2 text-emerald-300">{{ $disetujui }}</h2>
        </div>

        <div class="rounded-3xl bg-amber-500/10 border border-amber-500/20 p-6 shadow-xl">
            <p class="text-amber-300 text-sm">Sudah Dibaca</p>
            <h2 class="text-4xl font-black mt-2 text-amber-300">{{ $sudahDibaca }}</h2>
        </div>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 p-6 shadow-xl">
        <div class="flex justify-between mb-2">
            <p class="font-bold text-white">Progress Persetujuan</p>
            <p class="text-cyan-300 font-bold">{{ $persen }}%</p>
        </div>

        <div class="w-full h-4 rounded-full bg-white/10 overflow-hidden">
            <div class="h-4 rounded-full bg-gradient-to-r from-indigo-500 to-cyan-500"
                 style="width: {{ $persen }}%">
            </div>
        </div>

        <p class="text-slate-400 text-sm mt-2">
            {{ $disetujui }} dari {{ $total }} mahasiswa sudah menyetujui kontrak.
        </p>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/10 text-slate-300 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Mahasiswa</th>
                        <th class="px-5 py-4 text-left">NIM</th>
                        <th class="px-5 py-4 text-left">Prodi</th>
                        <th class="px-5 py-4 text-left">Status</th>
                        <th class="px-5 py-4 text-left">Waktu Baca</th>
                        <th class="px-5 py-4 text-left">Waktu Verifikasi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">
                    @forelse($verifikasi as $item)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-4">{{ $loop->iteration }}</td>

                            <td class="px-5 py-4 font-bold text-white">
                                {{ $item->mahasiswa->nama_lengkap
                                    ?? $item->mahasiswa->user->name
                                    ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->mahasiswa->nim ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->mahasiswa->prodi->nama_prodi ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if($item->status === 'disetujui')
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                                        Disetujui
                                    </span>
                                @elseif($item->status === 'sudah_dibaca')
                                    <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold">
                                        Sudah Dibaca
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-xs font-bold">
                                        Belum Dibaca
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->waktu_baca ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->waktu_verifikasi ?? '-' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-slate-400">
                                Belum ada mahasiswa yang membaca kontrak.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('kontrak.index') }}"
       class="inline-block px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
        ← Kembali
    </a>
</div>
@endsection