@extends('layouts.app', ['title' => 'Edit Program Studi', 'pageTitle' => 'Edit Program Studi'])

@section('content')
<div class="max-w-3xl rounded-[2rem] bg-white/10 border border-white/10 p-8 shadow-xl">

    <h2 class="text-2xl font-black mb-2">Edit Program Studi</h2>
    <p class="text-slate-400 mb-6">Perbarui data program studi.</p>

    @if($errors->any())
        <div class="mb-5 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 p-4 text-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.prodi.update', $prodi->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2 text-sm font-bold text-slate-300">Kode Prodi</label>
            <input type="text"
                   name="kode_prodi"
                   value="{{ old('kode_prodi', $prodi->kode_prodi) }}"
                   required
                   class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 outline-none">
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-slate-300">Nama Program Studi</label>
            <input type="text"
                   name="nama_prodi"
                   value="{{ old('nama_prodi', $prodi->nama_prodi) }}"
                   required
                   class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 outline-none">
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-slate-300">Fakultas</label>
            <input type="text"
                   name="fakultas"
                   value="{{ old('fakultas', $prodi->fakultas) }}"
                   class="w-full px-5 py-4 rounded-2xl bg-slate-950/80 border border-white/10 focus:border-cyan-400 outline-none">
        </div>

        <div class="flex gap-3">
            <button class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-black">
                Update
            </button>

            <a href="{{ route('admin.prodi.index') }}"
               class="px-6 py-3 rounded-2xl bg-white/10 font-bold">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection