@extends('layouts.app', ['title' => 'Edit RPS', 'pageTitle' => 'Edit RPS'])

@section('content')
<div class="max-w-3xl mx-auto rounded-3xl bg-white/5 border border-white/10 p-8 shadow-2xl">

    <h2 class="text-2xl font-black mb-6 text-white">Edit RPS</h2>

    @include('admin.partials.errors')

    <form action="{{ url('/rps/' . $rps->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm text-slate-400 mb-1">Mata Kuliah</label>
            <select name="mata_kuliah_id"
                    class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}"
                        {{ $rps->mata_kuliah_id == $mk->id ? 'selected' : '' }}>
                        {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Judul</label>
            <input type="text" name="judul"
                   value="{{ old('judul', $rps->judul) }}"
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">File RPS (opsional)</label>
            <input type="file" name="file_rps"
                   class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">

            @if($rps->file_rps)
                <p class="text-xs text-slate-400 mt-2">
                    File saat ini tersedia, akan diganti jika upload file baru.
                </p>
            @endif
        </div>

        <div>
            <label class="block text-sm text-slate-400 mb-1">Status</label>
            <select name="status"
                    class="w-full rounded-2xl bg-slate-950/70 border border-white/10 px-4 py-3 text-white">
                <option value="draft" {{ $rps->status == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="diajukan" {{ $rps->status == 'diajukan' ? 'selected' : '' }}>Ajukan</option>

                @if(auth()->user()->role === 'admin')
                    <option value="disetujui" {{ $rps->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ $rps->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                @endif
            </select>
        </div>

        <div class="flex gap-3 flex-wrap">
            <button type="submit"
                class="px-6 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 font-bold">
                Update
            </button>

            <a href="{{ url('/rps/' . $rps->id) }}"
               class="px-6 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                Detail
            </a>

            <a href="{{ route('rps.index') }}"
               class="px-6 py-3 rounded-2xl bg-white/10 hover:bg-white/20 font-bold">
                Batal
            </a>
        </div>

    </form>
</div>
@endsection