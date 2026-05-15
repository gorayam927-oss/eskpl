<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\RpsController;
use App\Http\Controllers\KontrakPerkuliahanController;
use App\Http\Controllers\VerifikasiKontrakController;
use App\Http\Controllers\TrackingCapaianController;
use App\Http\Controllers\LaporanController;

use App\Http\Controllers\Admin\ProdiController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\KelasController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/logout', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete-foto', [ProfileController::class, 'deleteFoto'])->name('profile.delete-foto');

    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('prodi', ProdiController::class);
            Route::resource('dosen', DosenController::class);
            Route::resource('mahasiswa', MahasiswaController::class);
            Route::resource('mata-kuliah', MataKuliahController::class);
            Route::resource('kelas', KelasController::class);
        });

    Route::resource('rps', RpsController::class);
    Route::post('/rps/{rps}/approve', [RpsController::class, 'approve'])->name('rps.approve');
    Route::get('/rps/{rps}/download', [RpsController::class, 'download'])->name('rps.download');

    Route::get('/kontrak', [KontrakPerkuliahanController::class, 'index'])->name('kontrak.index');
    Route::get('/kontrak/create', [KontrakPerkuliahanController::class, 'create'])->name('kontrak.create');
    Route::post('/kontrak', [KontrakPerkuliahanController::class, 'store'])->name('kontrak.store');
    Route::get('/kontrak/{id}', [KontrakPerkuliahanController::class, 'show'])->name('kontrak.show');
    Route::get('/kontrak/{id}/edit', [KontrakPerkuliahanController::class, 'edit'])->name('kontrak.edit');
    Route::put('/kontrak/{id}', [KontrakPerkuliahanController::class, 'update'])->name('kontrak.update');
    Route::delete('/kontrak/{id}', [KontrakPerkuliahanController::class, 'destroy'])->name('kontrak.destroy');
    Route::post('/kontrak/{id}/publish', [KontrakPerkuliahanController::class, 'publish'])->name('kontrak.publish');

    Route::get('/kontrak/{id}/monitoring-verifikasi', [VerifikasiKontrakController::class, 'monitoring'])->name('verifikasi.monitoring');

    Route::get('/verifikasi-kontrak', [VerifikasiKontrakController::class, 'index'])->name('verifikasi.index');
    Route::get('/verifikasi-kontrak/{id}', [VerifikasiKontrakController::class, 'show'])->name('verifikasi.show');
    Route::post('/verifikasi-kontrak/{id}/setujui', [VerifikasiKontrakController::class, 'setujui'])->name('verifikasi.setujui');

    Route::get('/tracking-capaian', [TrackingCapaianController::class, 'index'])->name('tracking.index');
    Route::get('/tracking-capaian/{id}', [TrackingCapaianController::class, 'show'])->name('tracking.show');
    Route::post('/tracking-capaian/{id}/cpmk', [TrackingCapaianController::class, 'storeCpmk'])->name('tracking.cpmk.store');
    Route::post('/tracking-capaian/{id}/pertemuan', [TrackingCapaianController::class, 'storePertemuan'])->name('tracking.pertemuan.store');
    Route::post('/tracking-capaian/{id}/nilai', [TrackingCapaianController::class, 'storeTracking'])->name('tracking.nilai.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
});