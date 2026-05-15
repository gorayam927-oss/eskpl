<?php

namespace App\Http\Controllers;

use App\Models\KontrakPerkuliahan;
use App\Models\Mahasiswa;
use App\Models\VerifikasiKontrak;
use Illuminate\Http\Request;

class VerifikasiKontrakController extends Controller
{
    public function index()
    {
        abort_if(auth()->user()->role !== 'mahasiswa', 403);

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $kontrak = KontrakPerkuliahan::with([
                'dosen.user',
                'mataKuliah',
                'rps',
                'verifikasi' => function ($query) use ($mahasiswa) {
                    $query->where('mahasiswa_id', $mahasiswa->id);
                }
            ])
            ->where('status', 'publish')
            ->latest()
            ->get();

        return view('verifikasi.index', compact('kontrak'));
    }

    public function show($id)
    {
        abort_if(auth()->user()->role !== 'mahasiswa', 403);

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $kontrak = KontrakPerkuliahan::with(['dosen.user', 'mataKuliah', 'rps'])
            ->where('status', 'publish')
            ->findOrFail($id);

        $verifikasi = VerifikasiKontrak::firstOrCreate(
            [
                'kontrak_id' => $kontrak->id,
                'mahasiswa_id' => $mahasiswa->id,
            ],
            [
                'status' => 'sudah_dibaca',
                'waktu_baca' => now(),
            ]
        );

        if ($verifikasi->status === 'belum_dibaca') {
            $verifikasi->update([
                'status' => 'sudah_dibaca',
                'waktu_baca' => now(),
            ]);
        }

        return view('verifikasi.show', compact('kontrak', 'verifikasi'));
    }

    public function setujui(Request $request, $id)
    {
        abort_if(auth()->user()->role !== 'mahasiswa', 403);

        $request->validate([
            'persetujuan' => ['required'],
        ]);

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        $kontrak = KontrakPerkuliahan::where('status', 'publish')->findOrFail($id);

        VerifikasiKontrak::updateOrCreate(
            [
                'kontrak_id' => $kontrak->id,
                'mahasiswa_id' => $mahasiswa->id,
            ],
            [
                'status' => 'disetujui',
                'waktu_baca' => now(),
                'waktu_verifikasi' => now(),
            ]
        );

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Kontrak berhasil diverifikasi.');
    }

    public function monitoring($id)
    {
        abort_if(!in_array(auth()->user()->role, ['admin', 'dosen']), 403);

        $kontrak = KontrakPerkuliahan::with(['dosen.user', 'mataKuliah', 'rps'])
            ->findOrFail($id);

        $verifikasi = VerifikasiKontrak::with(['mahasiswa.user', 'mahasiswa.prodi'])
            ->where('kontrak_id', $kontrak->id)
            ->latest()
            ->get();

        return view('verifikasi.monitoring', compact('kontrak', 'verifikasi'));
    }
}