@extends('layouts.app', ['title' => 'Laporan', 'pageTitle' => 'Laporan Akademik'])

@section('content')
<div class="space-y-6">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-white">Laporan Akademik</h1>
            <p class="text-slate-400 mt-1">Laporan kontrak, verifikasi, dan tracking capaian.</p>
        </div>

        <a href="{{ route('laporan.export.pdf', request()->query()) }}"
           class="px-5 py-3 rounded-2xl bg-rose-500/20 text-rose-300 hover:bg-rose-500/30 font-bold">
            Export PDF
        </a>
    </div>

    <form method="GET" action="{{ route('laporan.index') }}"
          class="rounded-3xl bg-white/5 border border-white/10 p-6 shadow-xl">
        <div class="grid md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm text-slate-400 mb-1">Program Studi</label>
                <select name="prodi_id"
                        class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
                    <option value="">Semua Prodi</option>
                    @foreach($prodi as $p)
                        <option value="{{ $p->id }}" {{ request('prodi_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_prodi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm text-slate-400 mb-1">Semester</label>
                <select name="semester"
                        class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
                    <option value="">Semua Semester</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>
                            Semester {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="flex items-end gap-3">
                <button class="px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
                    Filter
                </button>

                <a href="{{ route('laporan.index') }}"
                   class="px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                    Reset
                </a>
            </div>
        </div>
    </form>

    <div class="grid md:grid-cols-4 gap-5">
        <div class="p-6 rounded-3xl bg-indigo-500/10 border border-indigo-500/20">
            <p class="text-indigo-300 text-sm">Total Kontrak</p>
            <h2 class="text-4xl font-black mt-2">{{ $totalKontrak }}</h2>
        </div>

        <div class="p-6 rounded-3xl bg-cyan-500/10 border border-cyan-500/20">
            <p class="text-cyan-300 text-sm">Kontrak Publish</p>
            <h2 class="text-4xl font-black mt-2">{{ $totalPublish }}</h2>
        </div>

        <div class="p-6 rounded-3xl bg-emerald-500/10 border border-emerald-500/20">
            <p class="text-emerald-300 text-sm">Verifikasi Disetujui</p>
            <h2 class="text-4xl font-black mt-2">{{ $totalVerifikasi }}</h2>
        </div>

        <div class="p-6 rounded-3xl bg-amber-500/10 border border-amber-500/20">
            <p class="text-amber-300 text-sm">Tracking Capaian</p>
            <h2 class="text-4xl font-black mt-2">{{ $totalTracking }}</h2>
        </div>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 p-6 shadow-xl">
        <h2 class="text-xl font-black mb-4">Grafik Status Kontrak</h2>
        <div class="max-w-md">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/10 text-slate-300 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4 text-left">No</th>
                        <th class="px-5 py-4 text-left">Judul Kontrak</th>
                        <th class="px-5 py-4 text-left">Dosen</th>
                        <th class="px-5 py-4 text-left">Mata Kuliah</th>
                        <th class="px-5 py-4 text-left">Prodi</th>
                        <th class="px-5 py-4 text-left">Semester</th>
                        <th class="px-5 py-4 text-left">Status</th>
                        <th class="px-5 py-4 text-left">Verifikasi</th>
                        <th class="px-5 py-4 text-left">Tracking</th>
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
                                {{ $item->mataKuliah->nama_mk ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->mataKuliah->prodi->nama_prodi ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->mataKuliah->semester ?? '-' }}
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

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->verifikasi->where('status', 'disetujui')->count() }}
                            </td>

                            <td class="px-5 py-4 text-slate-300">
                                {{ $item->trackingCapaian->count() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-5 py-10 text-center text-slate-400">
                                Belum ada data laporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('statusChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode(array_keys($chartStatus)) !!},
        datasets: [{
            data: {!! json_encode(array_values($chartStatus)) !!},
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    color: '#e5e7eb'
                }
            }
        }
    }
});
</script>
@endsection