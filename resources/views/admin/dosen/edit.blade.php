@extends('layouts.app', ['title' => 'Edit Dosen', 'pageTitle' => 'Edit Dosen'])

@section('content')
<div class="max-w-4xl rounded-[2rem] bg-white/10 border border-white/10 p-8 shadow-xl">
    <h2 class="text-2xl font-black mb-6">Edit Dosen</h2>

    @include('admin.partials.errors')

    <form action="{{ route('admin.dosen.update', $dosen->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf
        @method('PUT')

        <input name="name" value="{{ old('name', $dosen->user->name) }}" class="input" required>
        <input name="email" type="email" value="{{ old('email', $dosen->user->email) }}" class="input" required>
        <input name="password" type="password" class="input" placeholder="Password baru, kosongkan jika tidak diubah">

        <select name="prodi_id" class="input">
            <option value="">-- Pilih Prodi --</option>
            @foreach($prodi as $p)
                <option value="{{ $p->id }}" {{ old('prodi_id', $dosen->prodi_id) == $p->id ? 'selected' : '' }}>
                    {{ $p->nama_prodi }}
                </option>
            @endforeach
        </select>

        <input name="nidn" value="{{ old('nidn', $dosen->nidn) }}" class="input" required>
        <input name="nama_lengkap" value="{{ old('nama_lengkap', $dosen->nama_lengkap) }}" class="input" required>
        <input name="no_hp" value="{{ old('no_hp', $dosen->no_hp) }}" class="input">
        <textarea name="alamat" class="input md:col-span-2">{{ old('alamat', $dosen->alamat) }}</textarea>

        <div class="md:col-span-2 flex gap-3">
            <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-black">Update</button>
            <a href="{{ route('admin.dosen.index') }}" class="px-6 py-3 rounded-2xl bg-white/10 font-bold">Kembali</a>
        </div>
    </form>
</div>

<style>
.input { width:100%; padding:1rem 1.25rem; border-radius:1rem; background:rgba(2,6,23,.8); border:1px solid rgba(255,255,255,.1); outline:none; }
.input:focus { border-color:#22d3ee; }
</style>
@endsection