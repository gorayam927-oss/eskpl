<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $prodi = Prodi::latest()->paginate(10);

        return view('admin.prodi.index', compact('prodi'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.prodi.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'kode_prodi' => ['required', 'unique:prodi,kode_prodi', 'max:20'],
            'nama_prodi' => ['required', 'max:100'],
            'fakultas' => ['nullable', 'max:100'],
        ]);

        Prodi::create([
            'kode_prodi' => strtoupper($request->kode_prodi),
            'nama_prodi' => $request->nama_prodi,
            'fakultas' => $request->fakultas,
        ]);

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Data program studi berhasil ditambahkan.');
    }

    public function show(Prodi $prodi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.prodi.show', compact('prodi'));
    }

    public function edit(Prodi $prodi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'kode_prodi' => ['required', 'max:20', 'unique:prodi,kode_prodi,' . $prodi->id],
            'nama_prodi' => ['required', 'max:100'],
            'fakultas' => ['nullable', 'max:100'],
        ]);

        $prodi->update([
            'kode_prodi' => strtoupper($request->kode_prodi),
            'nama_prodi' => $request->nama_prodi,
            'fakultas' => $request->fakultas,
        ]);

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Data program studi berhasil diperbarui.');
    }

    public function destroy(Prodi $prodi)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $prodi->delete();

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Data program studi berhasil dihapus.');
    }
}