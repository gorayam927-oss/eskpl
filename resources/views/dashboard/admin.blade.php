@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="space-y-8">
    <div class="rounded-[2rem] bg-gradient-to-r from-indigo-500/30 via-sky-500/20 to-cyan-500/30 border border-white/10 p-8 shadow-2xl">
        <p class="text-cyan-300 font-bold uppercase tracking-widest text-sm">Admin Panel</p>
        <h1 class="text-4xl font-black mt-3">Dashboard Admin</h1>
        <p class="text-slate-300 mt-2">Pantau seluruh data akademik E-SKPL.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        @php
            $cards = [
                ['label' => 'Total Dosen', 'value' => $totalDosen, 'icon' => '🧑‍🏫'],
                ['label' => 'Total Mahasiswa', 'value' => $totalMahasiswa, 'icon' => '🎓'],
                ['label' => 'Total Kontrak', 'value' => $totalKontrak, 'icon' => '📝'],
                ['label' => 'Total RPS', 'value' => $totalRps, 'icon' => '📄'],
                ['label' => 'Program Studi', 'value' => $totalProdi, 'icon' => '🏫'],
                ['label' => 'Mata Kuliah', 'value' => $totalMataKuliah, 'icon' => '📚'],
                ['label' => 'Kelas', 'value' => $totalKelas, 'icon' => '🏛️'],
                ['label' => 'Verifikasi', 'value' => $totalVerifikasi, 'icon' => '✅'],
            ];
        @endphp

        @foreach($cards as $card)
            <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6 shadow-xl hover:-translate-y-1 transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400">{{ $card['label'] }}</p>
                        <h2 class="text-4xl font-black mt-3">{{ $card['value'] }}</h2>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center text-3xl">
                        {{ $card['icon'] }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 rounded-3xl bg-slate-900/80 border border-white/10 p-6">
            <h2 class="text-2xl font-black mb-6">Grafik Aktivitas</h2>

            <div class="space-y-5">
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-slate-300">Dosen</span>
                        <span class="text-cyan-300 font-bold">{{ $totalDosen }}</span>
                    </div>
                    <div class="h-4 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-cyan-500 rounded-full" style="width: {{ min($totalDosen * 10, 100) }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-slate-300">Mahasiswa</span>
                        <span class="text-cyan-300 font-bold">{{ $totalMahasiswa }}</span>
                    </div>
                    <div class="h-4 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width: {{ min($totalMahasiswa * 10, 100) }}%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-slate-300">Kontrak</span>
                        <span class="text-cyan-300 font-bold">{{ $totalKontrak }}</span>
                    </div>
                    <div class="h-4 bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min($totalKontrak * 10, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-slate-900/80 border border-white/10 p-6">
            <h2 class="text-2xl font-black mb-6">User Terbaru</h2>

            <div class="space-y-4">
                @forelse($recentUsers as $item)
                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10">
                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-400 flex items-center justify-center font-black">
                            {{ strtoupper(substr($item->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold">{{ $item->name }}</p>
                            <p class="text-xs text-cyan-300 uppercase">{{ $item->role }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-slate-400">Belum ada user.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection