@extends('layouts.app', ['title' => 'Upload RPS', 'pageTitle' => 'Upload RPS'])

@section('content')
<div class="max-w-4xl mx-auto rounded-[2rem] bg-white/10 border border-white/10 p-8 shadow-2xl">

    <div class="mb-8">
        <h2 class="text-3xl font-black">Upload RPS</h2>
        <p class="text-slate-400 mt-2">
            Upload file RPS dalam format PDF, DOC, atau DOCX.
        </p>
    </div>

    @include('admin.partials.errors')

    <form action="{{ route('rps.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf

        <div>
            <label class="label">Mata Kuliah</label>
            <select name="mata_kuliah_id" class="input" required>
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach($mataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ old('mata_kuliah_id') == $mk->id ? 'selected' : '' }}>
                        {{ $mk->kode_mk }} - {{ $mk->nama_mk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="label">Judul RPS</label>
            <input type="text"
                   name="judul"
                   value="{{ old('judul') }}"
                   class="input"
                   placeholder="Contoh: RPS Pemrograman Web"
                   required>
        </div>

        <div>
            <label class="label">File RPS</label>
            <input type="file"
                   name="file_rps"
                   class="input file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-cyan-500 file:text-white file:font-bold"
                   accept=".pdf,.doc,.docx"
                   required>

            <p class="text-xs text-slate-400 mt-2">
                Format file: PDF, DOC, DOCX. Maksimal 5 MB.
            </p>
        </div>

        <div>
            <label class="label">Status</label>
            <select name="status" class="input" required>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>
                    Simpan sebagai Draft
                </option>
                <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>
                    Ajukan ke Admin
                </option>
            </select>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit"
                    class="px-7 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-cyan-500 hover:from-indigo-600 hover:to-cyan-600 font-black shadow-lg shadow-cyan-500/30 transition">
                Simpan RPS
            </button>

            <a href="{{ route('rps.index') }}"
               class="px-7 py-4 rounded-2xl bg-white/10 hover:bg-white/20 font-bold transition">
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
    font-weight: 800;
    color: #cbd5e1;
}

.input {
    width: 100%;
    padding: 1rem 1.25rem;
    border-radius: 1rem;
    background: rgba(2, 6, 23, .92);
    border: 1px solid rgba(255, 255, 255, .15);
    color: #ffffff;
    outline: none;
}

.input::placeholder {
    color: #94a3b8;
}

.input:focus {
    border-color: #22d3ee;
    box-shadow: 0 0 0 4px rgba(34, 211, 238, .12);
}

select.input option {
    background: #020617;
    color: #ffffff;
}
</style>
@endsection