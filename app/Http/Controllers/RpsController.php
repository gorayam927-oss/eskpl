<?php

namespace App\Http\Controllers;

use App\Models\Rps;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RpsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (in_array($user->role, ['admin', 'dosen'])) {
            $rps = Rps::with(['dosen.user', 'mataKuliah'])
                ->latest()
                ->paginate(10);
        } else {
            abort(403);
        }

        return view('rps.index', compact('rps'));
    }

    public function create()
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();

        return view('rps.create', compact('mataKuliah'));
    }

    public function store(Request $request)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $request->validate([
            'mata_kuliah_id' => ['required', 'exists:mata_kuliah,id'],
            'judul' => ['required', 'max:150'],
            'file_rps' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'status' => ['required', 'in:draft,diajukan'],
        ]);

        $path = $request->file('file_rps')->store('rps', 'public');

        Rps::create([
            'dosen_id' => auth()->user()->dosen->id ?? null,
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'judul' => $request->judul,
            'file_rps' => $path,
            'status' => $request->status,
        ]);

        return redirect()->route('rps.index')->with('success', 'RPS berhasil diupload.');
    }

    public function show(Rps $rps)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $rps->load(['dosen.user', 'mataKuliah']);

        return view('rps.show', compact('rps'));
    }

    public function edit(Rps $rps)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();

        return view('rps.edit', compact('rps', 'mataKuliah'));
    }

    public function update(Request $request, Rps $rps)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $request->validate([
            'mata_kuliah_id' => ['required', 'exists:mata_kuliah,id'],
            'judul' => ['required', 'max:150'],
            'file_rps' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'status' => ['required', 'in:draft,diajukan,disetujui,ditolak'],
        ]);

        $data = [
            'mata_kuliah_id' => $request->mata_kuliah_id,
            'judul' => $request->judul,
            'status' => $request->status,
        ];

        if ($request->hasFile('file_rps')) {
            if ($rps->file_rps && Storage::disk('public')->exists($rps->file_rps)) {
                Storage::disk('public')->delete($rps->file_rps);
            }

            $data['file_rps'] = $request->file('file_rps')->store('rps', 'public');
        }

        $rps->update($data);

        return redirect()->route('rps.index')->with('success', 'RPS berhasil diperbarui.');
    }

    public function approve(Request $request, Rps $rps)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'status' => ['required', 'in:disetujui,ditolak'],
            'catatan' => ['nullable'],
        ]);

        $rps->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Status RPS berhasil diperbarui.');
    }

    public function download(Rps $rps)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        if (!$rps->file_rps || !Storage::disk('public')->exists($rps->file_rps)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($rps->file_rps);
    }

    public function destroy(Rps $rps)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        if ($rps->file_rps && Storage::disk('public')->exists($rps->file_rps)) {
            Storage::disk('public')->delete($rps->file_rps);
        }

        $rps->delete();

        return back()->with('success', 'RPS berhasil dihapus.');
    }
}