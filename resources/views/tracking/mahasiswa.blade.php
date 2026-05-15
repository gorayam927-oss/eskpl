@extends('layouts.app', ['title' => 'Capaian Saya', 'pageTitle' => 'Capaian Saya'])

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-black text-white">Capaian Pembelajaran Saya</h1>
        <p class="text-slate-400 mt-1">Lihat progres capaian pembelajaran kamu.</p>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/10 text-slate-300 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4 text-left">Mata Kuliah</th>
                        <th class="px-5 py-4 text-left">Pertemuan</th>
                        <th class="px-5 py-4 text-left">CPMK</th>
                        <th class="px-5 py-4 text-left">Nilai</th>
                        <th class="px-5 py-4 text-left">Persentase</th>
                        <th class="px-5 py-4 text-left">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">
                    @forelse($tracking as $item)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-4 font-bold text-white">
                                {{ $item->kontrak->mataKuliah->nama_mk ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                Pertemuan {{ $item->pertemuan->pertemuan_ke ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->cpmk->kode_cpmk ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->nilai }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->persentase }}%
                            </td>

                            <td class="px-5 py-4">
                                @if($item->status == 'tercapai')
                                    <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-bold">
                                        Tercapai
                                    </span>
                                @elseif($item->status == 'proses')
                                    <span class="px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 text-xs font-bold">
                                        Proses
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full bg-slate-500/20 text-slate-300 text-xs font-bold">
                                        Belum
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-400">
                                Belum ada data capaian pembelajaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection