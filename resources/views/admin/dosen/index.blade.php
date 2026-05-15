@extends('layouts.app', ['title' => 'Data Dosen', 'pageTitle' => 'Data Dosen'])

@section('content')
<div class="rounded-[2rem] bg-white/10 border border-white/10 p-6 shadow-xl">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-black">Dosen</h2>
            <p class="text-slate-400 text-sm">Kelola data dosen.</p>
        </div>

        <a href="{{ route('admin.dosen.create') }}"
           class="px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold hover:scale-105 transition">
            + Tambah Dosen
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/10 text-left text-slate-400">
                    <th class="py-4 px-4">No</th>
                    <th class="py-4 px-4">NIDN</th>
                    <th class="py-4 px-4">Nama</th>
                    <th class="py-4 px-4">Email</th>
                    <th class="py-4 px-4">Prodi</th>
                    <th class="py-4 px-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($dosen as $item)
                    <tr class="border-b border-white/5 hover:bg-white/5 transition">
                        <td class="py-4 px-4">{{ $loop->iteration }}</td>

                        <td class="py-4 px-4">
                            {{ $item->nidn }}
                        </td>

                        <td class="py-4 px-4 font-bold text-white">
                            {{ $item->nama_lengkap ?? $item->user->name ?? '-' }}
                        </td>

                        <td class="py-4 px-4">
                            {{ $item->user->email ?? '-' }}
                        </td>

                        <td class="py-4 px-4">
                            {{ $item->prodi->nama_prodi ?? '-' }}
                        </td>

                        <td class="py-4 px-4">
                            <div class="flex justify-end gap-2 flex-wrap">

                                {{-- DETAIL --}}
                                <a href="{{ route('admin.dosen.show', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-cyan-500/20 text-cyan-300 font-bold hover:bg-cyan-500/30">
                                    Detail
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('admin.dosen.edit', $item->id) }}"
                                   class="px-4 py-2 rounded-xl bg-amber-500/20 text-amber-300 font-bold hover:bg-amber-500/30">
                                    Edit
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.dosen.destroy', $item->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus data dosen?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-4 py-2 rounded-xl bg-rose-500/20 text-rose-300 font-bold hover:bg-rose-500/30">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-slate-400">
                            Belum ada data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $dosen->links() }}
    </div>

</div>
@endsection