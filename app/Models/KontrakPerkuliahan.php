<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakPerkuliahan extends Model
{
    protected $table = 'kontrak_perkuliahans';

    protected $fillable = [
        'rps_id',
        'dosen_id',
        'mata_kuliah_id',
        'judul_kontrak',
        'deskripsi_mata_kuliah',
        'jadwal',
        'metode_pembelajaran',
        'aturan_kehadiran',
        'sistem_penilaian',
        'referensi_belajar',
        'cpmk',
        'cpl',
        'status',
    ];

    public function rps()
    {
        return $this->belongsTo(Rps::class, 'rps_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function verifikasi()
    {
        return $this->hasMany(VerifikasiKontrak::class, 'kontrak_id');
    }

    // Jangan pakai nama cpmk(), karena bentrok dengan kolom cpmk di tabel kontrak_perkuliahan
    public function daftarCpmk()
    {
        return $this->hasMany(Cpmk::class, 'kontrak_id');
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class, 'kontrak_id');
    }

    public function trackingCapaian()
    {
        return $this->hasMany(TrackingCapaian::class, 'kontrak_id');
    }
}