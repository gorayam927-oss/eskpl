@extends('layouts.app', ['title' => 'Data Kelas', 'pageTitle' => 'Data Kelas'])

@section('content')
<div class="rounded-[2rem] bg-white/10 border border-white/10 p-6 shadow-xl">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-black">Kelas</h2>
            <p class="text-slate-400 text-sm mt-1">Kelola kelas perkuliahan.</p>
        </div>

        <a href="{{ route('admin.kelas.create') }}"
           class="px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold shadow-lg shadow-cyan-500/20 hover:scale-105 transition">
            + Tambah Kelas
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/10 text-left text-slate-400">
                    <th class="py-4 px-4">No</th>
                    <th class="py-4 px-4">Kelas</th>
                    <th class="py-4 px-4">Mata Kuliah</th>
                    <th class="py-4 px-4">Dosen</th>
                    <th class="py-4 px-4">Semester</th>
                    <th class="py-4 px-4">Jadwal</th>
                    <th class="py-4 px-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kelas as $item)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">
                        <td class="py-4 px-4">
                            {{ $loop->iteration + ($kelas->currentPage() - 1) * $kelas->perPage() }}
                        </td>

                        <td class="py-4 px-4">
                            <span class="px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-300 font-bold">
                                {{ $item->nama_kelas ?? '-' }}
                            </span>
                        </td>

                        <td class="py-4 px-4 font-semibold text-white">
                            {{ $item->mataKuliah->nama_mk 
                                ?? $item->mataKuliah->nama_mata_kuliah 
                                ?? '-' }}
                        </td>

                        <td class="py-4 px-4 text-slate-300">
                            {{ $item->dosen->nama_lengkap 
                                ?? $item->dosen->user->name 
                                ?? '-' }}
                        </td>

                        <td class="py-4 px-4 text-slate-300">
                            {{ ucfirst($item->semester_aktif ?? '-') }} - {{ $item->tahun_akademik ?? '-' }}
                        </td>

                        <td class="py-4 px-4 text-slate-300">
                            {{ $item->hari ?? '-' }}

                            @if($item->jam_mulai && $item->jam_selesai)
                                <br>
                                <span class="text-xs text-slate-400">
                                    {{ substr($item->jam_mulai, 0, 5) }} - {{ substr($item->jam_selesai, 0, 5) }}
                                </span>
                            @endif

                            <br>
                            <span class="text-xs text-slate-400">
                                {{ $item->ruangan ?? '-' }}
                            </span>
                        </td>

                        <td class="py-4 px-4">
                            <div class="flex justify-end gap-2 flex-wrap">

                                <a href="{{ route('admin.kelas.show', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-300 font-bold hover:bg-cyan-500/30 transition">
                                    Detail
                                </a>

                                <a href="{{ route('admin.kelas.edit', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-amber-500/20 text-amber-300 font-bold hover:bg-amber-500/30 transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.kelas.destroy', $item->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kelas ini?')">
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
                            Belum ada data kelas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $kelas->links() }}
    </div>
</div>
@endsection