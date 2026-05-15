<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'E-SKPL' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        .glass {
            background: rgba(15, 23, 42, 0.78);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .card-glow {
            box-shadow: 0 24px 80px rgba(59, 130, 246, 0.18);
        }
    </style>
</head>

<body class="bg-slate-950 text-white">

<div class="min-h-screen bg-[radial-gradient(circle_at_top_left,#312e81,transparent_35%),radial-gradient(circle_at_bottom_right,#0891b2,transparent_35%)]">

@auth
<div class="flex min-h-screen">

    <aside class="hidden lg:flex w-72 glass border-r border-white/10 flex-col">

        <div class="p-6 border-b border-white/10">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-3xl bg-gradient-to-br from-indigo-500 via-blue-500 to-cyan-400 flex items-center justify-center font-black text-2xl card-glow">
                    E
                </div>

                <div>
                    <h1 class="text-2xl font-black tracking-tight">E-SKPL</h1>
                    <p class="text-xs text-slate-400">Smart Academic Contract</p>
                </div>
            </div>
        </div>

        <nav class="p-4 flex-1 space-y-2 overflow-y-auto">

            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl font-bold transition
               {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-cyan-500 text-white shadow-lg shadow-cyan-500/20' : 'hover:bg-white/10 text-slate-300' }}">
                <span>🏠</span>
                <span>Dashboard</span>
            </a>

            @if(auth()->user()->role === 'admin')
                <p class="px-4 pt-5 pb-2 text-xs text-slate-500 uppercase font-black">Master Data</p>

                <a href="{{ route('admin.prodi.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.prodi.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>🏫</span>
                    <span>Program Studi</span>
                </a>

                <a href="{{ route('admin.dosen.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.dosen.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>🧑‍🏫</span>
                    <span>Dosen</span>
                </a>

                <a href="{{ route('admin.mahasiswa.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.mahasiswa.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>🎓</span>
                    <span>Mahasiswa</span>
                </a>

                <a href="{{ route('admin.mata-kuliah.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.mata-kuliah.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📚</span>
                    <span>Mata Kuliah</span>
                </a>

                <a href="{{ route('admin.kelas.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('admin.kelas.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>🏛️</span>
                    <span>Kelas</span>
                </a>

                <p class="px-4 pt-5 pb-2 text-xs text-slate-500 uppercase font-black">Akademik</p>

                <a href="{{ route('rps.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('rps.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📄</span>
                    <span>RPS</span>
                </a>

                <a href="{{ route('kontrak.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('kontrak.*') || request()->routeIs('verifikasi.monitoring') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📝</span>
                    <span>Kontrak Perkuliahan</span>
                </a>

                <a href="{{ route('tracking.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('tracking.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📈</span>
                    <span>Tracking Capaian</span>
                </a>

                <a href="{{ route('laporan.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('laporan.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📊</span>
                    <span>Laporan</span>
                </a>
            @endif

            @if(auth()->user()->role === 'dosen')
                <p class="px-4 pt-5 pb-2 text-xs text-slate-500 uppercase font-black">Menu Dosen</p>

                <a href="{{ route('rps.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('rps.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📄</span>
                    <span>Upload RPS</span>
                </a>

                <a href="{{ route('kontrak.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('kontrak.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📝</span>
                    <span>Kontrak Perkuliahan</span>
                </a>

                <a href="{{ route('tracking.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('tracking.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📈</span>
                    <span>Tracking Capaian</span>
                </a>
            @endif

            @if(auth()->user()->role === 'mahasiswa')
                <p class="px-4 pt-5 pb-2 text-xs text-slate-500 uppercase font-black">Menu Mahasiswa</p>

                <a href="{{ route('kontrak.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('kontrak.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📝</span>
                    <span>Kontrak Saya</span>
                </a>

                <a href="{{ route('verifikasi.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('verifikasi.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>✅</span>
                    <span>Verifikasi Kontrak</span>
                </a>

                <a href="{{ route('tracking.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('tracking.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                    <span>📈</span>
                    <span>Capaian Saya</span>
                </a>
            @endif

            <p class="px-4 pt-5 pb-2 text-xs text-slate-500 uppercase font-black">Akun</p>

            <a href="{{ route('profile') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-2xl transition {{ request()->routeIs('profile') || request()->routeIs('profile.*') ? 'bg-white/10 text-white font-bold' : 'hover:bg-white/10 text-slate-300' }}">
                <span>👤</span>
                <span>Profil Saya</span>
            </a>
        </nav>

        <div class="p-4 border-t border-white/10">
            <div class="rounded-3xl bg-white/5 border border-white/10 p-4">
                <div class="flex items-center gap-3">
                    @if(auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                             class="w-12 h-12 rounded-full object-cover border-2 border-cyan-400">
                    @else
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-400 flex items-center justify-center font-black text-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif

                    <div class="min-w-0">
                        <p class="font-bold leading-tight truncate">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-cyan-300 uppercase mt-1">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 min-w-0">

        <header class="sticky top-0 z-20 glass border-b border-white/10">
            <div class="px-6 lg:px-10 py-5 flex items-center justify-between gap-4">

                <div>
                    <h2 class="text-2xl font-black">
                        @yield('title', $pageTitle ?? 'Dashboard')
                    </h2>

                    <p class="text-sm text-slate-400">
                        Sistem Kontrak Perkuliahan Online
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('profile') }}" class="hidden md:flex items-center gap-3 rounded-2xl bg-white/5 border border-white/10 px-4 py-3 hover:bg-white/10 transition">
                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                 class="w-9 h-9 rounded-full object-cover border border-cyan-400">
                        @else
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-cyan-400 flex items-center justify-center font-black">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                        @endif

                        <div class="text-left">
                            <p class="text-sm font-bold leading-tight">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-cyan-300 uppercase">
                                {{ auth()->user()->role }}
                            </p>
                        </div>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="px-5 py-3 rounded-2xl bg-rose-500 hover:bg-rose-600 font-bold shadow-lg shadow-rose-500/30 transition">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <div class="lg:hidden p-4 border-b border-white/10 glass">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-indigo-500 to-cyan-400 flex items-center justify-center font-black">
                        E
                    </div>
                    <div>
                        <p class="font-black">E-SKPL</p>
                        <p class="text-xs text-slate-400">Smart Academic Contract</p>
                    </div>
                </div>

                <a href="{{ route('profile') }}" class="text-sm px-4 py-2 rounded-xl bg-white/10">
                    Profil
                </a>
            </div>
        </div>

        <section class="p-6 lg:p-10">

            @if(session('success'))
                <div class="mb-6 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-300 p-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')

        </section>
    </main>
</div>
@else
    @yield('content')
@endauth

</div>

</body>
</html>