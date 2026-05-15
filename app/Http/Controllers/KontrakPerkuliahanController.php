<?php

namespace App\Http\Controllers;

use App\Models\KontrakPerkuliahan;
use App\Models\Rps;
use App\Models\Dosen;
use App\Models\MataKuliah;
use Illuminate\Http\Request;

class KontrakPerkuliahanController extends Controller
{
    public function index()
    {
        $kontrak = KontrakPerkuliahan::with(['rps', 'dosen.user', 'mataKuliah'])
            ->latest()
            ->get();

        return view('admin.kontrak.index', compact('kontrak'));
    }

    public function create()
    {
        $rps = Rps::latest()->get();
        $dosen = Dosen::with('user')->latest()->get();
        $mataKuliah = MataKuliah::latest()->get();

        return view('admin.kontrak.create', compact('rps', 'dosen', 'mataKuliah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_kontrak' => 'required|string|max:255',
            'dosen_id' => 'required',
            'mata_kuliah_id' => 'required',
            'status' => 'required|in:draft,publish',
        ]);

        KontrakPerkuliahan::create([
            'rps_id' => $request->rps_id,
            'dosen_id' => $request->dosen_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'judul_kontrak' => $request->judul_kontrak,
            'deskripsi_mata_kuliah' => $request->deskripsi_mata_kuliah,
            'jadwal' => $request->jadwal,
            'metode_pembelajaran' => $request->metode_pembelajaran,
            'aturan_kehadiran' => $request->aturan_kehadiran,
            'sistem_penilaian' => $request->sistem_penilaian,
            'referensi_belajar' => $request->referensi_belajar,
            'cpmk' => $request->cpmk,
            'cpl' => $request->cpl,
            'status' => $request->status,
        ]);

        return redirect()->route('kontrak.index')
            ->with('success', 'Kontrak perkuliahan berhasil dibuat.');
    }

    public function show($id)
    {
        $kontrak = KontrakPerkuliahan::with(['rps', 'dosen.user', 'mataKuliah'])
            ->findOrFail($id);

        return view('admin.kontrak.show', compact('kontrak'));
    }

    public function edit($id)
    {
        $kontrak = KontrakPerkuliahan::findOrFail($id);
        $rps = Rps::latest()->get();
        $dosen = Dosen::with('user')->latest()->get();
        $mataKuliah = MataKuliah::latest()->get();

        return view('admin.kontrak.edit', compact('kontrak', 'rps', 'dosen', 'mataKuliah'));
    }

    public function update(Request $request, $id)
    {
        $kontrak = KontrakPerkuliahan::findOrFail($id);

        $request->validate([
            'judul_kontrak' => 'required|string|max:255',
            'dosen_id' => 'required',
            'mata_kuliah_id' => 'required',
            'status' => 'required|in:draft,publish',
        ]);

        $kontrak->update([
            'rps_id' => $request->rps_id,
            'dosen_id' => $request->dosen_id,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'judul_kontrak' => $request->judul_kontrak,
            'deskripsi_mata_kuliah' => $request->deskripsi_mata_kuliah,
            'jadwal' => $request->jadwal,
            'metode_pembelajaran' => $request->metode_pembelajaran,
            'aturan_kehadiran' => $request->aturan_kehadiran,
            'sistem_penilaian' => $request->sistem_penilaian,
            'referensi_belajar' => $request->referensi_belajar,
            'cpmk' => $request->cpmk,
            'cpl' => $request->cpl,
            'status' => $request->status,
        ]);

        return redirect()->route('kontrak.index')
            ->with('success', 'Kontrak perkuliahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kontrak = KontrakPerkuliahan::findOrFail($id);
        $kontrak->delete();

        return redirect()->route('kontrak.index')
            ->with('success', 'Kontrak perkuliahan berhasil dihapus.');
    }

    public function publish($id)
    {
        $kontrak = KontrakPerkuliahan::findOrFail($id);

        $kontrak->update([
            'status' => 'publish',
        ]);

        return redirect()->route('kontrak.index')
            ->with('success', 'Kontrak berhasil dipublish.');
    }
}