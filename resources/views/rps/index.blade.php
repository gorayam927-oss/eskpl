@extends('layouts.app', ['title' => 'RPS', 'pageTitle' => 'Data RPS'])

@section('content')
<div class="rounded-[2rem] bg-white/10 border border-white/10 p-6">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-black">Data RPS</h2>

        @if(auth()->user()->role == 'dosen')
        <a href="{{ route('rps.create') }}"
           class="px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
            + Upload RPS
        </a>
        @endif
    </div>

    <div class="overflow-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400">
                    <th class="pb-3">Judul</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Status</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rps as $item)
                <tr class="border-t border-white/10 hover:bg-white/5 transition">
                    <td class="py-3 font-bold text-white">{{ $item->judul }}</td>

                    <td>
                        {{ $item->mataKuliah->nama_mk 
                           ?? $item->mataKuliah->nama_mata_kuliah 
                           ?? '-' }}
                    </td>

                    <td>
                        {{ $item->dosen->nama_lengkap 
                           ?? $item->dosen->user->name 
                           ?? '-' }}
                    </td>

                    <td>
                        @if($item->status == 'disetujui')
                            <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                                Disetujui
                            </span>
                        @elseif($item->status == 'diajukan')
                            <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold">
                                Diajukan
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-xs font-bold">
                                Draft
                            </span>
                        @endif
                    </td>

                    <td class="text-right space-x-3">

                        {{-- DETAIL --}}
                        <a href="{{ route('rps.show', $item->id) }}"
                           class="text-cyan-300 hover:underline font-bold">
                            Detail
                        </a>

                        {{-- DOWNLOAD --}}
                        <a href="{{ route('rps.download', $item->id) }}"
                           class="text-blue-300 hover:underline font-bold">
                            Download
                        </a>

                        {{-- EDIT --}}
                        @if(auth()->user()->role == 'dosen')
                        <a href="{{ route('rps.edit', $item->id) }}"
                           class="text-yellow-300 hover:underline font-bold">
                            Edit
                        </a>
                        @endif

                        {{-- APPROVE --}}
                        @if(auth()->user()->role == 'admin')
                        <form action="{{ route('rps.approve', $item->id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="disetujui">
                            <button class="text-green-400 hover:underline font-bold">
                                Approve
                            </button>
                        </form>
                        @endif

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-slate-400">
                        Belum ada data RPS
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $rps->links() }}
    </div>

</div>
@endsection