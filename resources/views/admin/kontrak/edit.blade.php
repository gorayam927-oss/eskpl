@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div>
        <h1 class="text-3xl font-black text-white">Edit Kontrak Perkuliahan</h1>
        <p class="text-slate-400 mt-1">Perbarui data kontrak perkuliahan</p>
    </div>

    @if ($errors->any())
        <div class="rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4">
            <p class="font-bold mb-2">Ada kesalahan input:</p>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kontrak.update', $kontrak->id) }}" method="POST"
          class="rounded-3xl bg-white/5 border border-white/10 p-6 lg:p-8 shadow-2xl space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2 font-bold text-slate-300">Judul Kontrak</label>
            <input type="text" name="judul_kontrak" value="{{ old('judul_kontrak', $kontrak->judul_kontrak) }}" required
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        <div class="grid md:grid-cols-3 gap-5">
            <div>
                <label class="block mb-2 font-bold text-slate-300">RPS</label>
                <select name="rps_id"
                        class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">
                    <option value="">Pilih RPS</option>
                    @foreach($rps as $item)
                        <option value="{{ $item->id }}" {{ old('rps_id', $kontrak->rps_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->judul ?? 'RPS ID: ' . $item->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 font-bold text-slate-300">Dosen</label>
                <select name="dosen_id" required
                        class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">
                    <option value="">Pilih Dosen</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->id }}" {{ old('dosen_id', $kontrak->dosen_id) == $d->id ? 'selected' : '' }}>
                            {{ $d->nama_dosen 
                                ?? $d->nama 
                                ?? $d->user->name 
                                ?? $d->email 
                                ?? 'Dosen ID: ' . $d->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-2 font-bold text-slate-300">Mata Kuliah</label>
                <select name="mata_kuliah_id" required
                        class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">
                    <option value="">Pilih Mata Kuliah</option>
                    @foreach($mataKuliah as $mk)
                        <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $kontrak->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>
                            {{ $mk->nama_mata_kuliah ?? $mk->nama ?? $mk->kode_mk ?? 'Mata Kuliah ID: ' . $mk->id }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block mb-2 font-bold text-slate-300">Deskripsi Mata Kuliah</label>
            <textarea name="deskripsi_mata_kuliah" rows="3"
                      class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">{{ old('deskripsi_mata_kuliah', $kontrak->deskripsi_mata_kuliah) }}</textarea>
        </div>

        <div>
            <label class="block mb-2 font-bold text-slate-300">Jadwal Kuliah</label>
            <input type="text" name="jadwal" value="{{ old('jadwal', $kontrak->jadwal) }}"
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">
        </div>

        @foreach([
            'metode_pembelajaran' => 'Metode Pembelajaran',
            'aturan_kehadiran' => 'Aturan Kehadiran',
            'sistem_penilaian' => 'Sistem Penilaian',
            'referensi_belajar' => 'Referensi Belajar',
            'cpmk' => 'CPMK',
            'cpl' => 'CPL',
        ] as $name => $label)
            <div>
                <label class="block mb-2 font-bold text-slate-300">{{ $label }}</label>
                <textarea name="{{ $name }}" rows="3"
                          class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">{{ old($name, $kontrak->$name) }}</textarea>
            </div>
        @endforeach

        <div>
            <label class="block mb-2 font-bold text-slate-300">Status</label>
            <select name="status" required
                    class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white outline-none focus:ring-2 focus:ring-cyan-400">
                <option value="draft" {{ old('status', $kontrak->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="publish" {{ old('status', $kontrak->status) == 'publish' ? 'selected' : '' }}>Publish</option>
            </select>
        </div>

        <div class="flex flex-wrap gap-3 pt-4">
            <button type="submit"
                    class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 text-white font-bold shadow-lg shadow-cyan-500/20 hover:scale-105 transition">
                Update
            </button>

            <a href="{{ route('kontrak.index') }}"
               class="px-6 py-3 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-bold transition">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection