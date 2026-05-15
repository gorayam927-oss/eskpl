@extends('layouts.app', ['title' => 'Tambah Dosen', 'pageTitle' => 'Tambah Dosen'])

@section('content')
<div class="max-w-4xl rounded-[2rem] bg-white/10 border border-white/10 p-8 shadow-xl">
    <h2 class="text-2xl font-black mb-6">Tambah Dosen</h2>

    @include('admin.partials.errors')

    <form action="{{ route('admin.dosen.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf

        <input name="name" value="{{ old('name') }}" class="input" placeholder="Nama akun" required>
        <input name="email" type="email" value="{{ old('email') }}" class="input" placeholder="Email login" required>
        <input name="password" type="password" class="input" placeholder="Password" required>

        <select name="prodi_id" class="input">
            <option value="">-- Pilih Prodi --</option>
            @foreach($prodi as $p)
                <option value="{{ $p->id }}">{{ $p->nama_prodi }}</option>
            @endforeach
        </select>

        <input name="nidn" value="{{ old('nidn') }}" class="input" placeholder="NIDN" required>
        <input name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="input" placeholder="Nama lengkap dosen" required>
        <input name="no_hp" value="{{ old('no_hp') }}" class="input" placeholder="No HP">
        <textarea name="alamat" class="input md:col-span-2" placeholder="Alamat">{{ old('alamat') }}</textarea>

        <div class="md:col-span-2 flex gap-3">
            <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-black">Simpan</button>
            <a href="{{ route('admin.dosen.index') }}" class="px-6 py-3 rounded-2xl bg-white/10 font-bold">Kembali</a>
        </div>
    </form>
</div>

<style>
.input { width:100%; padding:1rem 1.25rem; border-radius:1rem; background:rgba(2,6,23,.8); border:1px solid rgba(255,255,255,.1); outline:none; }
.input:focus { border-color:#22d3ee; }
</style>
@endsection