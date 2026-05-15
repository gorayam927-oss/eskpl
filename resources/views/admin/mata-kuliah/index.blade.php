@extends('layouts.app', ['title' => 'Data Mata Kuliah', 'pageTitle' => 'Data Mata Kuliah'])

@section('content')
<div class="rounded-[2rem] bg-white/10 border border-white/10 p-6 shadow-xl">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-black">Mata Kuliah</h2>
            <p class="text-slate-400 text-sm mt-1">Kelola data mata kuliah.</p>
        </div>

        <a href="{{ route('admin.mata-kuliah.create') }}"
           class="px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold shadow-lg shadow-cyan-500/20 hover:scale-105 transition">
            + Tambah Mata Kuliah
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/10 text-left text-slate-400">
                    <th class="py-4 px-4">No</th>
                    <th class="py-4 px-4">Kode</th>
                    <th class="py-4 px-4">Nama Mata Kuliah</th>
                    <th class="py-4 px-4">Prodi</th>
                    <th class="py-4 px-4">SKS</th>
                    <th class="py-4 px-4">Semester</th>
                    <th class="py-4 px-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($mataKuliah as $item)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">

                        <td class="py-4 px-4">
                            {{ $loop->iteration + ($mataKuliah->currentPage() - 1) * $mataKuliah->perPage() }}
                        </td>

                        <td class="py-4 px-4">
                            <span class="px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-300 font-bold">
                                {{ $item->kode_mk ?? $item->kode_mata_kuliah ?? '-' }}
                            </span>
                        </td>

                        <td class="py-4 px-4 font-bold text-white">
                            {{ $item->nama_mk ?? $item->nama_mata_kuliah ?? '-' }}
                        </td>

                        <td class="py-4 px-4 text-slate-300">
                            {{ $item->prodi->nama_prodi ?? $item->prodi->nama ?? '-' }}
                        </td>

                        <td class="py-4 px-4 text-slate-300">
                            {{ $item->sks ?? '-' }}
                        </td>

                        <td class="py-4 px-4 text-slate-300">
                            {{ $item->semester ?? '-' }}
                        </td>

                        <td class="py-4 px-4">
                            <div class="flex justify-end gap-2 flex-wrap">

                                {{-- DETAIL --}}
                                <a href="{{ route('admin.mata-kuliah.show', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-300 font-bold hover:bg-cyan-500/30 transition">
                                    Detail
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('admin.mata-kuliah.edit', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-amber-500/20 text-amber-300 font-bold hover:bg-amber-500/30 transition">
                                    Edit
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.mata-kuliah.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-4 py-2 rounded-xl bg-rose-500/20 text-rose-300 font-bold hover:bg-rose-500/30 transition">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-400">
                            Belum ada data mata kuliah.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $mataKuliah->links() }}
    </div>
</div>
@endsection