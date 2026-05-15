@extends('layouts.app', ['title' => 'Tracking Capaian', 'pageTitle' => 'Tracking Capaian'])

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-black text-white">Tracking Capaian Pembelajaran</h1>
        <p class="text-slate-400 mt-1">Pilih kontrak perkuliahan untuk mengisi capaian mahasiswa.</p>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/10 text-slate-300 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Kontrak</th>
                        <th class="px-5 py-4 text-left">Mata Kuliah</th>
                        <th class="px-5 py-4 text-left">Dosen</th>
                        <th class="px-5 py-4 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">
                    @forelse($kontrak as $item)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-4">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4 font-bold text-white">{{ $item->judul_kontrak }}</td>
                            <td class="px-5 py-4 text-slate-300">{{ $item->mataKuliah->nama_mk ?? '-' }}</td>
                            <td class="px-5 py-4 text-slate-300">{{ $item->dosen->nama_lengkap ?? $item->dosen->user->name ?? '-' }}</td>
                            <td class="px-5 py-4">
                                <a href="{{ route('tracking.show', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-300 font-bold">
                                    Kelola Tracking
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-slate-400">
                                Belum ada kontrak.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection