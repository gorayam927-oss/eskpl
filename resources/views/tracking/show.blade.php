@extends('layouts.app', ['title' => 'Kelola Tracking', 'pageTitle' => 'Kelola Tracking'])

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-3xl font-black text-white">Kelola Tracking Capaian</h1>
        <p class="text-slate-400 mt-1">{{ $kontrak->judul_kontrak }}</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <form action="{{ route('tracking.cpmk.store', $kontrak->id) }}" method="POST"
              class="rounded-3xl bg-white/5 border border-white/10 p-6 space-y-4">
            @csrf

            <h2 class="text-xl font-black">Tambah CPMK</h2>

            <input type="text" name="kode_cpmk" placeholder="Contoh: CPMK-1" required
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">

            <textarea name="deskripsi" placeholder="Deskripsi CPMK" required
                      class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white"></textarea>

            <input type="number" name="bobot" placeholder="Bobot (%)" min="0" max="100"
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">

            <button class="px-5 py-3 rounded-2xl bg-cyan-500/20 text-cyan-300 font-bold hover:bg-cyan-500/30">
                Simpan CPMK
            </button>
        </form>

        <form action="{{ route('tracking.pertemuan.store', $kontrak->id) }}" method="POST"
              class="rounded-3xl bg-white/5 border border-white/10 p-6 space-y-4">
            @csrf

            <h2 class="text-xl font-black">Tambah Pertemuan</h2>

            <input type="number" name="pertemuan_ke" placeholder="Pertemuan ke-" required min="1"
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">

            <input type="date" name="tanggal"
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">

            <input type="text" name="materi" placeholder="Materi"
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">

            <textarea name="catatan" placeholder="Catatan"
                      class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white"></textarea>

            <button class="px-5 py-3 rounded-2xl bg-emerald-500/20 text-emerald-300 font-bold hover:bg-emerald-500/30">
                Simpan Pertemuan
            </button>
        </form>
    </div>

    <form action="{{ route('tracking.nilai.store', $kontrak->id) }}" method="POST"
          class="rounded-3xl bg-white/5 border border-white/10 p-6 space-y-4">
        @csrf

        <h2 class="text-xl font-black">Input Tracking Mahasiswa</h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
            <select name="mahasiswa_id" required
                    class="rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
                <option value="">Pilih Mahasiswa</option>
                @foreach($mahasiswa ?? [] as $m)
                    <option value="{{ $m->id }}">
                        {{ $m->nama_lengkap ?? $m->user->name ?? '-' }} - {{ $m->nim ?? '-' }}
                    </option>
                @endforeach
            </select>

            <select name="pertemuan_id" required
                    class="rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
                <option value="">Pilih Pertemuan</option>
                @foreach($kontrak->pertemuan ?? [] as $p)
                    <option value="{{ $p->id }}">
                        Pertemuan {{ $p->pertemuan_ke }} - {{ $p->materi ?? '-' }}
                    </option>
                @endforeach
            </select>

            <select name="cpmk_id" required
                    class="rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
                <option value="">Pilih CPMK</option>
                @foreach($kontrak->daftarCpmk ?? [] as $c)
                    <option value="{{ $c->id }}">
                        {{ $c->kode_cpmk }} - {{ Str::limit($c->deskripsi, 35) }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="nilai" min="0" max="100" placeholder="Nilai 0-100" required
                   class="rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
        </div>

        <textarea name="catatan" placeholder="Catatan tracking"
                  class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white"></textarea>

        <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
            Simpan Tracking
        </button>
    </form>

    <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-white/10 text-slate-300 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-4 text-left">Mahasiswa</th>
                        <th class="px-5 py-4 text-left">Pertemuan</th>
                        <th class="px-5 py-4 text-left">CPMK</th>
                        <th class="px-5 py-4 text-left">Nilai</th>
                        <th class="px-5 py-4 text-left">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-white/10">
                    @forelse($tracking as $item)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-5 py-4 text-white font-bold">
                                {{ $item->mahasiswa->nama_lengkap ?? $item->mahasiswa->user->name ?? '-' }}
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
                            <td colspan="5" class="px-5 py-10 text-center text-slate-400">
                                Belum ada tracking capaian.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('tracking.index') }}"
       class="inline-block px-5 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
        ← Kembali
    </a>
</div>
@endsection