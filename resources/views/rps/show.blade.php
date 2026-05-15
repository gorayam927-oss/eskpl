@extends('layouts.app', ['title' => 'Detail RPS', 'pageTitle' => 'Detail RPS'])

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div>
        <h1 class="text-3xl font-black text-white">Detail RPS</h1>
        <p class="text-slate-400 mt-1">Informasi lengkap Rencana Pembelajaran Semester</p>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 p-8 shadow-2xl space-y-6">

        <div>
            <p class="text-slate-400 text-sm">Judul RPS</p>
            <p class="text-white font-bold text-lg">
                {{ $rps->judul ?? '-' }}
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <p class="text-slate-400 text-sm">Dosen</p>
                <p class="text-white font-bold">
                    {{ $rps->dosen->nama_lengkap
                        ?? $rps->dosen->user->name
                        ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">Mata Kuliah</p>
                <p class="text-white font-bold">
                    {{ $rps->mataKuliah->nama_mk
                        ?? $rps->mataKuliah->nama_mata_kuliah
                        ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-slate-400 text-sm">Status</p>

                @if($rps->status == 'disetujui')
                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                        Disetujui
                    </span>
                @elseif($rps->status == 'diajukan')
                    <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold">
                        Diajukan
                    </span>
                @elseif($rps->status == 'ditolak')
                    <span class="px-3 py-1 rounded-full bg-rose-500/20 text-rose-300 text-xs font-bold">
                        Ditolak
                    </span>
                @else
                    <span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-xs font-bold">
                        Draft
                    </span>
                @endif
            </div>

        </div>

        <div class="border-t border-white/10"></div>

        <div>
            <p class="text-slate-400 text-sm mb-2">File RPS</p>

            @if(!empty($rps->file_rps))
                <a href="{{ url('/rps/' . $rps->id . '/download') }}"
                   class="inline-block px-5 py-3 rounded-2xl bg-cyan-500/20 text-cyan-300 hover:bg-cyan-500/30 font-bold">
                    Download File RPS
                </a>
            @else
                <p class="text-slate-400">File RPS belum tersedia.</p>
            @endif
        </div>

        @if(!empty($rps->catatan))
            <div>
                <p class="text-slate-400 text-sm">Catatan Admin</p>
                <p class="text-white font-bold">
                    {{ $rps->catatan }}
                </p>
            </div>
        @endif

        <div class="border-t border-white/10"></div>

        <div class="flex gap-3 flex-wrap">

            <a href="{{ route('rps.index') }}"
               class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                ← Kembali
            </a>

            @if(in_array(auth()->user()->role, ['admin', 'dosen']))
                <a href="{{ url('/rps/' . $rps->id . '/edit') }}"
                   class="px-5 py-3 rounded-2xl bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 font-bold">
                    Edit
                </a>
            @endif

        </div>

    </div>
</div>
@endsection