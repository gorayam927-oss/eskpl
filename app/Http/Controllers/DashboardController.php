<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\Rps;
use App\Models\KontrakPerkuliahan;
use App\Models\VerifikasiKontrak;
use App\Models\TrackingCapaian;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('dashboard.admin', [
                'totalUsers' => User::count(),
                'totalDosen' => Dosen::count(),
                'totalMahasiswa' => Mahasiswa::count(),
                'totalProdi' => Prodi::count(),
                'totalMataKuliah' => MataKuliah::count(),
                'totalKelas' => Kelas::count(),
                'totalRps' => Rps::count(),
                'totalKontrak' => KontrakPerkuliahan::count(),
                'totalVerifikasi' => VerifikasiKontrak::where('status', 'sudah')->count(),
                'recentUsers' => User::latest()->take(5)->get(),
            ]);
        }

        if ($user->role === 'dosen') {
            $dosen = $user->dosen;

            return view('dashboard.dosen', [
                'dosen' => $dosen,
                'totalRps' => $dosen ? Rps::where('dosen_id', $dosen->id)->count() : 0,
                'totalKontrak' => $dosen ? KontrakPerkuliahan::where('dosen_id', $dosen->id)->count() : 0,
                'kontrakPublish' => $dosen ? KontrakPerkuliahan::where('dosen_id', $dosen->id)->where('status', 'publish')->count() : 0,
                'recentKontrak' => $dosen ? KontrakPerkuliahan::with('mataKuliah')->where('dosen_id', $dosen->id)->latest()->take(5)->get() : collect(),
            ]);
        }

        $mahasiswa = $user->mahasiswa;

        return view('dashboard.mahasiswa', [
            'mahasiswa' => $mahasiswa,
            'totalVerifikasi' => $mahasiswa ? VerifikasiKontrak::where('mahasiswa_id', $mahasiswa->id)->where('status', 'sudah')->count() : 0,
            'totalTracking' => $mahasiswa ? TrackingCapaian::where('mahasiswa_id', $mahasiswa->id)->count() : 0,
            'progressCapaian' => $mahasiswa ? round(TrackingCapaian::where('mahasiswa_id', $mahasiswa->id)->avg('persentase') ?? 0) : 0,
            'recentTracking' => $mahasiswa ? TrackingCapaian::with('kontrak')->where('mahasiswa_id', $mahasiswa->id)->latest()->take(5)->get() : collect(),
        ]);
    }
}