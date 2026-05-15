<?php

namespace App\Http\Controllers;

use App\Models\KontrakPerkuliahan;
use App\Models\VerifikasiKontrak;
use App\Models\TrackingCapaian;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $query = KontrakPerkuliahan::with(['dosen.user', 'mataKuliah.prodi', 'verifikasi', 'trackingCapaian']);

        if ($request->filled('prodi_id')) {
            $query->whereHas('mataKuliah', function ($q) use ($request) {
                $q->where('prodi_id', $request->prodi_id);
            });
        }

        if ($request->filled('semester')) {
            $query->whereHas('mataKuliah', function ($q) use ($request) {
                $q->where('semester', $request->semester);
            });
        }

        $kontrak = $query->latest()->get();

        $totalKontrak = $kontrak->count();
        $totalPublish = $kontrak->where('status', 'publish')->count();
        $totalVerifikasi = VerifikasiKontrak::whereIn('kontrak_id', $kontrak->pluck('id'))
            ->where('status', 'disetujui')
            ->count();

        $totalTracking = TrackingCapaian::whereIn('kontrak_id', $kontrak->pluck('id'))->count();

        $prodi = Prodi::orderBy('nama_prodi')->get();

        $chartStatus = [
            'Draft' => $kontrak->where('status', 'draft')->count(),
            'Publish' => $kontrak->where('status', 'publish')->count(),
        ];

        return view('laporan.index', compact(
            'kontrak',
            'prodi',
            'totalKontrak',
            'totalPublish',
            'totalVerifikasi',
            'totalTracking',
            'chartStatus'
        ));
    }

    public function exportPdf(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $query = KontrakPerkuliahan::with(['dosen.user', 'mataKuliah.prodi', 'verifikasi', 'trackingCapaian']);

        if ($request->filled('prodi_id')) {
            $query->whereHas('mataKuliah', function ($q) use ($request) {
                $q->where('prodi_id', $request->prodi_id);
            });
        }

        if ($request->filled('semester')) {
            $query->whereHas('mataKuliah', function ($q) use ($request) {
                $q->where('semester', $request->semester);
            });
        }

        $kontrak = $query->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('kontrak'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-e-skpl.pdf');
    }
}