<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerifikasiKontrak extends Model
{
    protected $table = 'verifikasi_kontrak';

    protected $fillable = [
        'kontrak_id',
        'mahasiswa_id',
        'status',
        'waktu_baca',
        'waktu_verifikasi',
    ];

    public function kontrak()
    {
        return $this->belongsTo(KontrakPerkuliahan::class, 'kontrak_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}