<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kelas;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $kelas = Kelas::with(['mataKuliah', 'dosen.user'])->latest()->paginate(10);

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();
        $dosen = Dosen::with('user')->orderBy('nama_lengkap')->get();

        return view('admin.kelas.create', compact('mataKuliah', 'dosen'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'mata_kuliah_id' => ['required', 'exists:mata_kuliah,id'],
            'dosen_id' => ['nullable', 'exists:dosen,id'],
            'nama_kelas' => ['required', 'max:50'],
            'tahun_akademik' => ['required', 'max:20'],
            'semester_aktif' => ['required', 'in:ganjil,genap'],
            'hari' => ['nullable', 'max:20'],
            'jam_mulai' => ['nullable'],
            'jam_selesai' => ['nullable'],
            'ruangan' => ['nullable', 'max:100'],
        ]);

        Kelas::create([
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'dosen_id' => $request->dosen_id,
            'nama_kelas' => $request->nama_kelas,
            'tahun_akademik' => $request->tahun_akademik,
            'semester_aktif' => $request->semester_aktif,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
        ]);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function show(Kelas $kela)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $kelas = $kela->load(['mataKuliah', 'dosen.user']);

        return view('admin.kelas.show', compact('kelas'));
    }

    public function edit(Kelas $kela)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $kelas = $kela;
        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();
        $dosen = Dosen::with('user')->orderBy('nama_lengkap')->get();

        return view('admin.kelas.edit', compact('kelas', 'mataKuliah', 'dosen'));
    }

    public function update(Request $request, Kelas $kela)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'mata_kuliah_id' => ['required', 'exists:mata_kuliah,id'],
            'dosen_id' => ['nullable', 'exists:dosen,id'],
            'nama_kelas' => ['required', 'max:50'],
            'tahun_akademik' => ['required', 'max:20'],
            'semester_aktif' => ['required', 'in:ganjil,genap'],
            'hari' => ['nullable', 'max:20'],
            'jam_mulai' => ['nullable'],
            'jam_selesai' => ['nullable'],
            'ruangan' => ['nullable', 'max:100'],
        ]);

        $kela->update([
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'dosen_id' => $request->dosen_id,
            'nama_kelas' => $request->nama_kelas,
            'tahun_akademik' => $request->tahun_akademik,
            'semester_aktif' => $request->semester_aktif,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
        ]);

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $kela->delete();

        return redirect()
            ->route('admin.kelas.index')
            ->with('success', 'Data kelas berhasil dihapus.');
    }
}