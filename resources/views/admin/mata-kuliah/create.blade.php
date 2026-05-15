@extends('layouts.app', ['title' => 'Tambah Mata Kuliah', 'pageTitle' => 'Tambah Mata Kuliah'])

@section('content')
<div class="max-w-4xl rounded-[2rem] bg-white/10 border border-white/10 p-8 shadow-xl">

    <h2 class="text-2xl font-black mb-2">Tambah Mata Kuliah</h2>
    <p class="text-slate-400 mb-6">Masukkan data mata kuliah baru.</p>

    @include('admin.partials.errors')

    <form action="{{ route('admin.mata-kuliah.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf

        <div>
            <label class="label">Program Studi</label>
            <select name="prodi_id" class="input">
                <option value="">-- Pilih Prodi --</option>
                @foreach($prodi as $p)
                    <option value="{{ $p->id }}" {{ old('prodi_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="label">Kode Mata Kuliah</label>
            <input type="text" name="kode_mk" value="{{ old('kode_mk') }}" class="input" placeholder="Contoh: IF101" required>
        </div>

        <div class="md:col-span-2">
            <label class="label">Nama Mata Kuliah</label>
            <input type="text" name="nama_mk" value="{{ old('nama_mk') }}" class="input" placeholder="Contoh: Pemrograman Web" required>
        </div>

        <div>
            <label class="label">SKS</label>
            <input type="number" name="sks" value="{{ old('sks', 3) }}" class="input" min="1" max="6" required>
        </div>

        <div>
            <label class="label">Semester</label>
            <input type="number" name="semester" value="{{ old('semester') }}" class="input" min="1" max="14" placeholder="Contoh: 4">
        </div>

        <div class="md:col-span-2 flex gap-3">
            <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-black">
                Simpan
            </button>

            <a href="{{ route('admin.mata-kuliah.index') }}"
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