<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingCapaian extends Model
{
    protected $table = 'tracking_capaian';

    protected $fillable = [
        'kontrak_id',
        'pertemuan_id',
        'cpmk_id',
        'mahasiswa_id',
        'nilai',
        'persentase',
        'status',
        'catatan',
    ];

    public function kontrak()
    {
        return $this->belongsTo(KontrakPerkuliahan::class, 'kontrak_id');
    }

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id');
    }

    public function cpmk()
    {
        return $this->belongsTo(Cpmk::class, 'cpmk_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}