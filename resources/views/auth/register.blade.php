@extends('layouts.app', ['title' => 'Register E-SKPL'])

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <div class="hidden lg:block">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-400/10 border border-cyan-300/20 text-cyan-200 text-sm font-bold mb-6">
                <span class="w-2 h-2 rounded-full bg-cyan-300"></span>
                Registrasi Akun E-SKPL
            </div>

            <h1 class="text-6xl font-black leading-tight">
                Buat Akun <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-blue-400 to-indigo-400">
                    Admin, Dosen, Mahasiswa
                </span>
            </h1>

            <p class="text-slate-300 text-lg mt-6 max-w-xl leading-relaxed">
                Daftar akun baru sesuai role pengguna. Setelah berhasil register,
                akun akan tersimpan ke database dan langsung masuk ke dashboard.
            </p>

            <div class="grid grid-cols-3 gap-4 mt-10">
                <div class="rounded-3xl bg-white/10 border border-white/10 p-5">
                    <p class="text-3xl font-black">👑</p>
                    <p class="text-sm text-slate-400 mt-2">Admin</p>
                </div>

                <div class="rounded-3xl bg-white/10 border border-white/10 p-5">
                    <p class="text-3xl font-black">🧑‍🏫</p>
                    <p class="text-sm text-slate-400 mt-2">Dosen</p>
                </div>

                <div class="rounded-3xl bg-white/10 border border-white/10 p-5">
                    <p class="text-3xl font-black">🎓</p>
                    <p class="text-sm text-slate-400 mt-2">Mahasiswa</p>
                </div>
            </div>
        </div>

        <div class="glass border border-white/10 rounded-[2rem] p-8 shadow-2xl card-glow">

            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto rounded-[1.7rem] bg-gradient-to-br from-indigo-500 via-blue-500 to-cyan-400 flex items-center justify-center text-3xl font-black shadow-lg shadow-cyan-500/30">
                    R
                </div>

                <h2 class="text-3xl font-black mt-5">Register Akun</h2>
                <p class="text-slate-400 mt-2">Pilih role dan isi data dengan benar</p>
            </div>

            @if($errors->any())
                <div class="mb-5 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.process') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-bold text-slate-300">
                        Nama Lengkap
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10 outline-none transition"
                           placeholder="Masukkan nama lengkap">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-slate-300">
                        Email
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10 outline-none transition"
                           placeholder="nama@email.com">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-slate-300">
                        Pilih Role
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="admin" class="peer hidden" {{ old('role') == 'admin' ? 'checked' : '' }}>
                            <div class="rounded-2xl border border-white/10 bg-slate-950/70 p-4 text-center peer-checked:border-cyan-400 peer-checked:bg-cyan-400/10 transition">
                                <div class="text-2xl mb-1">👑</div>
                                <div class="font-bold">Admin</div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="dosen" class="peer hidden" {{ old('role') == 'dosen' ? 'checked' : '' }}>
                            <div class="rounded-2xl border border-white/10 bg-slate-950/70 p-4 text-center peer-checked:border-cyan-400 peer-checked:bg-cyan-400/10 transition">
                                <div class="text-2xl mb-1">🧑‍🏫</div>
                                <div class="font-bold">Dosen</div>
                            </div>
                        </label>

                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="mahasiswa" class="peer hidden" {{ old('role') == 'mahasiswa' ? 'checked' : '' }}>
                            <div class="rounded-2xl border border-white/10 bg-slate-950/70 p-4 text-center peer-checked:border-cyan-400 peer-checked:bg-cyan-400/10 transition">
                                <div class="text-2xl mb-1">🎓</div>
                                <div class="font-bold">Mahasiswa</div>
                            </div>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-slate-300">
                        Password
                    </label>
                    <input type="password"
                           name="password"
                           required
                           class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10 outline-none transition"
                           placeholder="Minimal 6 karakter">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-slate-300">
                        Konfirmasi Password
                    </label>
                    <input type="password"
                           name="password_confirmation"
                           required
                           class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10 outline-none transition"
                           placeholder="Ulangi password">
                </div>

                <button class="w-full py-4 rounded-2xl bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 hover:from-indigo-600 hover:to-cyan-600 font-black shadow-lg shadow-cyan-500/30 transition">
                    Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-slate-400 text-sm mt-6">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-cyan-300 font-bold hover:underline">
                    Login di sini
                </a>
            </p>
        </div>
    </div>
</div>
@endsection