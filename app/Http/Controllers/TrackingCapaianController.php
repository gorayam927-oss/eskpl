<?php

namespace App\Http\Controllers;

use App\Models\KontrakPerkuliahan;
use App\Models\Mahasiswa;
use App\Models\Cpmk;
use App\Models\Pertemuan;
use App\Models\TrackingCapaian;
use Illuminate\Http\Request;

class TrackingCapaianController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'mahasiswa') {
            $mahasiswa = Mahasiswa::where('user_id', $user->id)->firstOrFail();

            $tracking = TrackingCapaian::with(['kontrak.mataKuliah', 'pertemuan', 'cpmk'])
                ->where('mahasiswa_id', $mahasiswa->id)
                ->latest()
                ->get();

            return view('tracking.mahasiswa', compact('tracking'));
        }

        abort_if(!in_array($user->role, ['admin', 'dosen']), 403);

        $kontrak = KontrakPerkuliahan::with(['dosen.user', 'mataKuliah'])
            ->latest()
            ->get();

        return view('tracking.index', compact('kontrak'));
    }

    public function show($id)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $kontrak = KontrakPerkuliahan::with([
                'dosen.user',
                'mataKuliah',
                'daftarCpmk',
                'pertemuan'
            ])
            ->findOrFail($id);

        $mahasiswa = Mahasiswa::with(['user', 'prodi'])
            ->orderBy('nama_lengkap')
            ->get();

        $tracking = TrackingCapaian::with(['mahasiswa.user', 'cpmk', 'pertemuan'])
            ->where('kontrak_id', $kontrak->id)
            ->latest()
            ->get();

        return view('tracking.show', compact('kontrak', 'mahasiswa', 'tracking'));
    }

    public function storeCpmk(Request $request, $id)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $request->validate([
            'kode_cpmk' => ['required', 'max:50'],
            'deskripsi' => ['required'],
            'bobot' => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        Cpmk::create([
            'kontrak_id' => $id,
            'kode_cpmk' => strtoupper($request->kode_cpmk),
            'deskripsi' => $request->deskripsi,
            'bobot' => $request->bobot ?? 0,
        ]);

        return back()->with('success', 'CPMK berhasil ditambahkan.');
    }

    public function storePertemuan(Request $request, $id)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $request->validate([
            'pertemuan_ke' => ['required', 'integer', 'min:1'],
            'tanggal' => ['nullable', 'date'],
            'materi' => ['nullable', 'max:255'],
            'catatan' => ['nullable'],
        ]);

        Pertemuan::create([
            'kontrak_id' => $id,
            'pertemuan_ke' => $request->pertemuan_ke,
            'tanggal' => $request->tanggal,
            'materi' => $request->materi,
            'catatan' => $request->catatan,
        ]);

        return back()->with('success', 'Pertemuan berhasil ditambahkan.');
    }

    public function storeTracking(Request $request, $id)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $request->validate([
            'mahasiswa_id' => ['required', 'exists:mahasiswa,id'],
            'pertemuan_id' => ['required', 'exists:pertemuan,id'],
            'cpmk_id' => ['required', 'exists:cpmk,id'],
            'nilai' => ['required', 'integer', 'min:0', 'max:100'],
            'catatan' => ['nullable'],
        ]);

        $persentase = $request->nilai;

        if ($persentase >= 75) {
            $status = 'tercapai';
        } elseif ($persentase > 0) {
            $status = 'proses';
        } else {
            $status = 'belum';
        }

        TrackingCapaian::updateOrCreate(
            [
                'kontrak_id' => $id,
                'mahasiswa_id' => $request->mahasiswa_id,
                'pertemuan_id' => $request->pertemuan_id,
                'cpmk_id' => $request->cpmk_id,
            ],
            [
                'nilai' => $request->nilai,
                'persentase' => $persentase,
                'status' => $status,
                'catatan' => $request->catatan,
            ]
        );

        return back()->with('success', 'Tracking capaian berhasil disimpan.');
    }
}