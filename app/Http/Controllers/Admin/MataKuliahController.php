<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataKuliah;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    public function index()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $mataKuliah = MataKuliah::with('prodi')->latest()->paginate(10);

        return view('admin.mata-kuliah.index', compact('mataKuliah'));
    }

    public function create()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('admin.mata-kuliah.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'prodi_id' => ['nullable', 'exists:prodi,id'],
            'kode_mk' => ['required', 'max:30', 'unique:mata_kuliah,kode_mk'],
            'nama_mk' => ['required', 'max:150'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:14'],
        ]);

        MataKuliah::create([
            'prodi_id' => $request->prodi_id,
            'kode_mk' => strtoupper($request->kode_mk),
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function show(MataKuliah $mataKuliah)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $mataKuliah->load('prodi');

        return view('admin.mata-kuliah.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('admin.mata-kuliah.edit', compact('mataKuliah', 'prodi'));
    }

    public function update(Request $request, MataKuliah $mataKuliah)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'prodi_id' => ['nullable', 'exists:prodi,id'],
            'kode_mk' => ['required', 'max:30', 'unique:mata_kuliah,kode_mk,' . $mataKuliah->id],
            'nama_mk' => ['required', 'max:150'],
            'sks' => ['required', 'integer', 'min:1', 'max:6'],
            'semester' => ['nullable', 'integer', 'min:1', 'max:14'],
        ]);

        $mataKuliah->update([
            'prodi_id' => $request->prodi_id,
            'kode_mk' => strtoupper($request->kode_mk),
            'nama_mk' => $request->nama_mk,
            'sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function destroy(MataKuliah $mataKuliah)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $mataKuliah->delete();

        return redirect()->route('admin.mata-kuliah.index')
            ->with('success', 'Data mata kuliah berhasil dihapus.');
    }
}