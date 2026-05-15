@extends('layouts.app', ['title' => 'Login E-SKPL'])

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <div class="hidden lg:block">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-400/10 border border-cyan-300/20 text-cyan-200 text-sm font-bold mb-6">
                <span class="w-2 h-2 rounded-full bg-cyan-300"></span>
                Sistem Akademik Modern
            </div>

            <h1 class="text-6xl font-black leading-tight">
                E-SKPL <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 via-blue-400 to-indigo-400">
                    Kontrak Perkuliahan Online
                </span>
            </h1>

            <p class="text-slate-300 text-lg mt-6 max-w-xl leading-relaxed">
                Platform modern untuk mengelola RPS, kontrak perkuliahan, verifikasi mahasiswa,
                tracking capaian pembelajaran, dan laporan akademik.
            </p>
        </div>

        <div class="glass border border-white/10 rounded-[2rem] p-8 shadow-2xl card-glow">

            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto rounded-[1.7rem] bg-gradient-to-br from-indigo-500 via-blue-500 to-cyan-400 flex items-center justify-center text-3xl font-black shadow-lg shadow-cyan-500/30">
                    E
                </div>

                <h2 class="text-3xl font-black mt-5">Masuk ke E-SKPL</h2>
                <p class="text-slate-400 mt-2">Gunakan akun yang sudah terdaftar</p>
            </div>

            @if($errors->any())
                <div class="mb-5 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block mb-2 text-sm font-bold text-slate-300">Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10 outline-none transition"
                           placeholder="nama@email.com">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold text-slate-300">Password</label>
                    <input type="password"
                           name="password"
                           required
                           class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 focus:ring-4 focus:ring-cyan-400/10 outline-none transition"
                           placeholder="Masukkan password">
                </div>

                <label class="flex items-center gap-2 text-sm text-slate-400">
                    <input type="checkbox" name="remember">
                    Ingat saya
                </label>

                <button class="w-full py-4 rounded-2xl bg-gradient-to-r from-indigo-500 via-blue-500 to-cyan-500 hover:from-indigo-600 hover:to-cyan-600 font-black shadow-lg shadow-cyan-500/30 transition">
                    Login Sekarang
                </button>
            </form>

            <p class="text-center text-slate-400 text-sm mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-cyan-300 font-bold hover:underline">
                    Register di sini
                </a>
            </p>
        </div>
    </div>
</div>
@endsection