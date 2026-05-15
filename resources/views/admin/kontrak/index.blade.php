@extends('layouts.app', ['title' => 'Kontrak Perkuliahan', 'pageTitle' => 'Kontrak Perkuliahan'])

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-white">Kontrak Perkuliahan</h1>
            <p class="text-slate-400 mt-1">Kelola kontrak perkuliahan online</p>
        </div>

        @if(in_array(auth()->user()->role, ['admin', 'dosen']))
            <a href="{{ route('kontrak.create') }}"
               class="inline-flex items-center justify-center px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 text-white font-bold shadow-lg shadow-cyan-500/20 hover:scale-105 transition">
                + Tambah Kontrak
            </a>
        @endif
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/10 text-slate-300 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Judul</th>
                        <th class="px-5 py-4 text-left">Dosen</th>
                        <th class="px-5 py-4 text-left">Mata Kuliah</th>
                        <th class="px-5 py-4 text-left">RPS</th>
                        <th class="px-5 py-4 text-left">Status</th>
                        <th class="px-5 py-4 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">
                    @forelse($kontrak as $item)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-4">{{ $loop->iteration }}</td>

                            <td class="px-5 py-4 font-bold text-white">
                                {{ $item->judul_kontrak }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->dosen->nama_lengkap ?? $item->dosen->user->name ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->mataKuliah->nama_mk
                                    ?? $item->mataKuliah->nama_mata_kuliah
                                    ?? $item->mataKuliah->nama
                                    ?? $item->mataKuliah->kode_mk
                                    ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->rps->judul ?? '-' }}
                            </td>

                            <td class="px-5 py-4">
                                @if($item->status == 'publish')
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                                        Publish
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-xs font-bold">
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-2">

                                    <a href="{{ route('kontrak.show', $item->id) }}"
                                       class="px-3 py-2 rounded-xl bg-cyan-500/20 text-cyan-300 hover:bg-cyan-500/30 font-bold">
                                        Detail
                                    </a>

                                    @if(auth()->user()->role === 'mahasiswa' && $item->status === 'publish')
                                        <a href="{{ route('verifikasi.show', $item->id) }}"
                                           class="px-3 py-2 rounded-xl bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500/30 font-bold">
                                            Verifikasi
                                        </a>
                                    @endif

                                    @if(in_array(auth()->user()->role, ['admin', 'dosen']))
                                        <a href="{{ route('verifikasi.monitoring', $item->id) }}"
                                           class="px-3 py-2 rounded-xl bg-purple-500/20 text-purple-300 hover:bg-purple-500/30 font-bold">
                                            Monitoring
                                        </a>

                                        <a href="{{ route('kontrak.edit', $item->id) }}"
                                           class="px-3 py-2 rounded-xl bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 font-bold">
                                            Edit
                                        </a>

                                        @if($item->status == 'draft')
                                            <form action="{{ route('kontrak.publish', $item->id) }}" method="POST">
                                                @csrf
                                                <button class="px-3 py-2 rounded-xl bg-emerald-500/20 text-emerald-300 hover:bg-emerald-500/30 font-bold">
                                                    Publish
                                                </button>
                                            </form>
                                        @endif

                                        <form action="{{ route('kontrak.destroy', $item->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus kontrak ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-2 rounded-xl bg-rose-500/20 text-rose-300 hover:bg-rose-500/30 font-bold">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-10 text-center text-slate-400">
                                Belum ada data kontrak perkuliahan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection