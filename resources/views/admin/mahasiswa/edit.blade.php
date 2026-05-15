@extends('layouts.app', ['title' => 'Edit Mahasiswa', 'pageTitle' => 'Edit Mahasiswa'])

@section('content')
<div class="max-w-5xl rounded-[2rem] bg-white/10 border border-white/10 p-8 shadow-xl">

    <h2 class="text-2xl font-black mb-2">Edit Mahasiswa</h2>
    <p class="text-slate-400 mb-6">Perbarui data akun dan profil mahasiswa.</p>

    @include('admin.partials.errors')

    <form action="{{ route('admin.mahasiswa.update', $mahasiswa->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-5">
        @csrf
        @method('PUT')

        <div>
            <label class="label">Nama Akun</label>
            <input type="text" name="name" value="{{ old('name', $mahasiswa->user->name) }}" class="input" required>
        </div>

        <div>
            <label class="label">Email Login</label>
            <input type="email" name="email" value="{{ old('email', $mahasiswa->user->email) }}" class="input" required>
        </div>

        <div>
            <label class="label">Password Baru</label>
            <input type="password" name="password" class="input" placeholder="Kosongkan jika tidak diubah">
        </div>

        <div>
            <label class="label">Program Studi</label>
            <select name="prodi_id" class="input">
                <option value="">-- Pilih Prodi --</option>
                @foreach($prodi as $p)
                    <option value="{{ $p->id }}" {{ old('prodi_id', $mahasiswa->prodi_id) == $p->id ? 'selected' : '' }}>
                        {{ $p->nama_prodi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="label">NIM</label>
            <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" class="input" required>
        </div>

        <div>
            <label class="label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $mahasiswa->nama_lengkap) }}" class="input" required>
        </div>

        <div>
            <label class="label">Angkatan</label>
            <input type="text" name="angkatan" value="{{ old('angkatan', $mahasiswa->angkatan) }}" class="input">
        </div>

        <div>
            <label class="label">No HP</label>
            <input type="text" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp) }}" class="input">
        </div>

        <div class="md:col-span-2">
            <label class="label">Alamat</label>
            <textarea name="alamat" class="input" rows="4">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
        </div>

        <div class="md:col-span-2 flex gap-3">
            <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-black">
                Update
            </button>

            <a href="{{ route('admin.mahasiswa.index') }}"
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