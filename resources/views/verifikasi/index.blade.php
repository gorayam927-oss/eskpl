@extends('layouts.app', ['title' => 'Verifikasi Kontrak', 'pageTitle' => 'Verifikasi Kontrak'])

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-black text-white">Verifikasi Kontrak</h1>
        <p class="text-slate-400 mt-1">Baca dan setujui kontrak perkuliahan yang sudah dipublish.</p>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/10 text-slate-300 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Judul</th>
                        <th class="px-5 py-4 text-left">Mata Kuliah</th>
                        <th class="px-5 py-4 text-left">Dosen</th>
                        <th class="px-5 py-4 text-left">Status</th>
                        <th class="px-5 py-4 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">
                    @forelse($kontrak as $item)
                        @php
                            $verif = $item->verifikasi->first();
                        @endphp

                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-4">{{ $loop->iteration }}</td>

                            <td class="px-5 py-4 font-bold text-white">
                                {{ $item->judul_kontrak }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->mataKuliah->nama_mk
                                    ?? $item->mataKuliah->nama_mata_kuliah
                                    ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->dosen->nama_lengkap
                                    ?? $item->dosen->user->name
                                    ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if($verif && $verif->status === 'disetujui')
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                                        Disetujui
                                    </span>
                                @elseif($verif && $verif->status === 'sudah_dibaca')
                                    <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold">
                                        Sudah Dibaca
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-xs font-bold">
                                        Belum Dibaca
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <a href="{{ route('verifikasi.show', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-300 hover:bg-cyan-500/30 font-bold">
                                    Baca Kontrak
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-400">
                                Belum ada kontrak yang dipublish.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection