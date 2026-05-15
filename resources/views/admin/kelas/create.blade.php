@extends('layouts.app', ['title' => 'Tambah Kelas', 'pageTitle' => 'Tambah Kelas'])

@section('content')
<div class="max-w-5xl rounded-[2rem] bg-white/10 border border-white/10 p-8 shadow-xl">

    <h2 class="text-2xl font-black mb-2">Tambah Kelas</h2>
    <p class="text-slate-400 mb-6">Masukkan data kelas perkuliahan.</p>

    @include('admin.partials.errors')

    <form action="{{ route('admin.kelas.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf

        <div>
            <label class="label">Mata Kuliah</label>
            <select name="mata_kuliah_id" class="input" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="label">Dosen Pengampu</label>
            <select name="dosen_id" class="input">
                <option value="">-- Pilih Dosen --</option>
                @foreach($dosen as $d)
                    <option value="{{ $d->id }}" {{ old('dosen_id') == $d->id ? 'selected' : '' }}>
                        {{ $d->nama_lengkap }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="label">Nama Kelas</label>
            <input type="text" name="nama_kelas" value="{{ old('nama_kelas') }}" class="input" placeholder="Contoh: TI-4A" required>
        </div>

        <div>
            <label class="label">Tahun Akademik</label>
            <input type="text" name="tahun_akademik" value="{{ old('tahun_akademik', '2025/2026') }}" class="input" placeholder="2025/2026" required>
        </div>

        <div>
            <label class="label">Semester Aktif</label>
            <select name="semester_aktif" class="input" required>
                <option value="">-- Pilih Semester --</option>
                <option value="ganjil" {{ old('semester_aktif') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                <option value="genap" {{ old('semester_aktif') == 'genap' ? 'selected' : '' }}>Genap</option>
            </select>
        </div>

        <div>
            <label class="label">Hari</label>
            <input type="text" name="hari" value="{{ old('hari') }}" class="input" placeholder="Contoh: Senin">
        </div>

        <div>
            <label class="label">Jam Mulai</label>
            <input type="time" name="jam_mulai" value="{{ old('jam_mulai') }}" class="input">
        </div>

        <div>
            <label class="label">Jam Selesai</label>
            <input type="time" name="jam_selesai" value="{{ old('jam_selesai') }}" class="input">
        </div>

        <div class="md:col-span-2">
            <label class="label">Ruangan</label>
            <input type="text" name="ruangan" value="{{ old('ruangan') }}" class="input" placeholder="Contoh: Lab Komputer 1">
        </div>

        <div class="md:col-span-2 flex gap-3">
            <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-black">
                Simpan
            </button>

            <a href="{{ route('admin.kelas.index') }}"
               class="px-6 py-3 rounded-2xl bg-white/10 font-bold">
                Kembali
            </a>
        </div>
    </form>
</div>

<style>
.label {
    display: block;
    margin-bottom: .5rem;
    font-size: .875rem;
    font-weight: 700;
    color: #cbd5e1;
}
.input {
    width: 100%;
    padding: 1rem 1.25rem;
    border-radius: 1rem;
    background: rgba(2, 6, 23, .8);
    border: 1px solid rgba(255, 255, 255, .1);
    outline: none;
}
.input:focus {
    border-color: #22d3ee;
}
</style>
@endsection