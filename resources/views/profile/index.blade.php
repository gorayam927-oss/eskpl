@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

@php
    $dosen = $user->dosen ?? null;
    $mahasiswa = $user->mahasiswa ?? null;

    $namaProfil = $user->name;
    $roleProfil = strtoupper($user->role);

    $prodiId = null;
    $noHp = null;
    $alamat = null;

    if ($user->role === 'dosen' && $dosen) {
        $prodiId = $dosen->prodi_id ?? null;
        $noHp = $dosen->no_hp ?? null;
        $alamat = $dosen->alamat ?? null;
    }

    if ($user->role === 'mahasiswa' && $mahasiswa) {
        $prodiId = $mahasiswa->prodi_id ?? null;
        $noHp = $mahasiswa->no_hp ?? null;
        $alamat = $mahasiswa->alamat ?? null;
    }
@endphp

<div class="max-w-6xl mx-auto">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- PROFILE CARD --}}
        <div class="glass rounded-3xl border border-white/10 p-8">

            <div class="flex flex-col items-center">

                {{-- FOTO --}}
                <div class="relative">

                    @if($user->foto)
                        <img src="{{ asset('storage/'.$user->foto) }}"
                             class="w-40 h-40 rounded-full object-cover border-4 border-cyan-400 shadow-2xl shadow-cyan-500/30">
                    @else
                        <div class="w-40 h-40 rounded-full bg-gradient-to-br from-indigo-500 via-blue-500 to-cyan-400 flex items-center justify-center text-5xl font-black shadow-2xl shadow-cyan-500/30">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="absolute bottom-2 right-2 w-6 h-6 bg-emerald-400 border-4 border-slate-900 rounded-full"></div>
                </div>

                <h2 class="mt-6 text-3xl font-black text-center">
                    {{ $user->name }}
                </h2>

                <p class="text-cyan-300 uppercase tracking-widest text-sm mt-2">
                    {{ $user->role }}
                </p>

                <div class="mt-8 w-full space-y-4">

                    <div class="glass rounded-2xl p-4 border border-white/10">
                        <p class="text-slate-400 text-sm">Email</p>
                        <p class="font-semibold mt-1 break-all">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div class="glass rounded-2xl p-4 border border-white/10">
                        <p class="text-slate-400 text-sm">Status</p>

                        @if($user->is_active)
                            <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 text-sm font-bold">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex mt-2 px-3 py-1 rounded-full bg-rose-500/20 text-rose-300 text-sm font-bold">
                                Tidak Aktif
                            </span>
                        @endif
                    </div>

                    <div class="glass rounded-2xl p-4 border border-white/10">
                        <p class="text-slate-400 text-sm">Bergabung</p>

                        <p class="font-semibold mt-1">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                        </p>
                    </div>

                    @if($user->role === 'dosen' && $dosen)
                        <div class="glass rounded-2xl p-4 border border-white/10">
                            <p class="text-slate-400 text-sm">NIDN</p>
                            <p class="font-semibold mt-1">
                                {{ $dosen->nidn ?? '-' }}
                            </p>
                        </div>
                    @endif

                    @if($user->role === 'mahasiswa' && $mahasiswa)
                        <div class="glass rounded-2xl p-4 border border-white/10">
                            <p class="text-slate-400 text-sm">NIM</p>
                            <p class="font-semibold mt-1">
                                {{ $mahasiswa->nim ?? '-' }}
                            </p>
                        </div>
                    @endif

                </div>

            </div>

        </div>

        {{-- FORM PROFILE --}}
        <div class="lg:col-span-2">

            <div class="glass rounded-3xl border border-white/10 p-8">

                <div class="mb-8">
                    <h2 class="text-3xl font-black">
                        Edit Profil
                    </h2>

                    <p class="text-slate-400 mt-2">
                        Kelola informasi akun dan lengkapi data profil kamu.
                    </p>
                </div>

                <form action="{{ route('profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- FOTO --}}
                    <div class="mb-8">

                        <label class="block text-sm font-bold mb-3 text-slate-300">
                            Foto Profil
                        </label>

                        <input type="file"
                               name="foto"
                               class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white">

                        @error('foto')
                            <p class="text-rose-400 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                        @if($user->foto)
                            <button type="submit"
                                    form="delete-foto-form"
                                    class="mt-4 px-5 py-3 rounded-2xl bg-rose-500/20 text-rose-300 font-bold hover:bg-rose-500/30">
                                Hapus Foto
                            </button>
                        @endif
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-6">

                        <label class="block text-sm font-bold mb-3 text-slate-300">
                            Nama Lengkap
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20"
                               required>

                        @error('name')
                            <p class="text-rose-400 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-6">

                        <label class="block text-sm font-bold mb-3 text-slate-300">
                            Email
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20"
                               required>

                        @error('email')
                            <p class="text-rose-400 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- ROLE --}}
                    <div class="mb-8">

                        <label class="block text-sm font-bold mb-3 text-slate-300">
                            Role
                        </label>

                        <input type="text"
                               readonly
                               value="{{ $roleProfil }}"
                               class="w-full rounded-2xl bg-slate-800 border border-white/10 px-5 py-4 text-cyan-300 font-bold">
                    </div>

                    {{-- DATA DOSEN --}}
                    @if($user->role === 'dosen' && $dosen)

                        <div class="mb-8">
                            <h3 class="text-2xl font-black mb-5">
                                Data Dosen
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        NIDN
                                    </label>

                                    <input type="text"
                                           name="nidn"
                                           value="{{ old('nidn', $dosen->nidn) }}"
                                           class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">

                                    @error('nidn')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        Program Studi
                                    </label>

                                    <select name="prodi_id"
                                            class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">
                                        <option value="">-- Pilih Program Studi --</option>

                                        @foreach($prodi as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('prodi_id', $prodiId) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('prodi_id')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        No HP
                                    </label>

                                    <input type="text"
                                           name="no_hp"
                                           value="{{ old('no_hp', $noHp) }}"
                                           placeholder="Contoh: 08123456789"
                                           class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">

                                    @error('no_hp')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        Nama Dosen
                                    </label>

                                    <input type="text"
                                           readonly
                                           value="{{ $dosen->nama ?? $dosen->nama_lengkap ?? $user->name }}"
                                           class="w-full rounded-2xl bg-slate-800 border border-white/10 px-5 py-4 text-slate-300">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        Alamat
                                    </label>

                                    <textarea name="alamat"
                                              rows="4"
                                              placeholder="Masukkan alamat lengkap"
                                              class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">{{ old('alamat', $alamat) }}</textarea>

                                    @error('alamat')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    @endif

                    {{-- DATA MAHASISWA --}}
                    @if($user->role === 'mahasiswa' && $mahasiswa)

                        <div class="mb-8">
                            <h3 class="text-2xl font-black mb-5">
                                Data Mahasiswa
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        NIM
                                    </label>

                                    <input type="text"
                                           name="nim"
                                           value="{{ old('nim', $mahasiswa->nim) }}"
                                           class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">

                                    @error('nim')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        Program Studi
                                    </label>

                                    <select name="prodi_id"
                                            class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">
                                        <option value="">-- Pilih Program Studi --</option>

                                        @foreach($prodi as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('prodi_id', $prodiId) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('prodi_id')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        Angkatan
                                    </label>

                                    <input type="text"
                                           name="angkatan"
                                           value="{{ old('angkatan', $mahasiswa->angkatan) }}"
                                           placeholder="Contoh: 2023"
                                           class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">

                                    @error('angkatan')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        No HP
                                    </label>

                                    <input type="text"
                                           name="no_hp"
                                           value="{{ old('no_hp', $noHp) }}"
                                           placeholder="Contoh: 08123456789"
                                           class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">

                                    @error('no_hp')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-bold mb-3 text-slate-300">
                                        Alamat
                                    </label>

                                    <textarea name="alamat"
                                              rows="4"
                                              placeholder="Masukkan alamat lengkap"
                                              class="w-full rounded-2xl bg-slate-900/80 border border-white/10 px-5 py-4 text-white focus:outline-none focus:ring-4 focus:ring-cyan-500/20">{{ old('alamat', $alamat) }}</textarea>

                                    @error('alamat')
                                        <p class="text-rose-400 text-sm mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    @endif

                    {{-- BUTTON --}}
                    <div class="flex flex-col md:flex-row gap-3">
                        <button class="px-8 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 hover:scale-105 transition font-black shadow-2xl shadow-cyan-500/30">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('dashboard') }}"
                           class="px-8 py-4 rounded-2xl bg-white/10 hover:bg-white/20 transition font-black text-center">
                            Kembali
                        </a>
                    </div>

                </form>

                @if($user->foto)
                    <form id="delete-foto-form"
                          action="{{ route('profile.delete-foto') }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus foto profil?')">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection