<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $table = 'pertemuan';

    protected $fillable = [
        'kontrak_id',
        'pertemuan_ke',
        'tanggal',
        'materi',
        'catatan',
    ];

    public function kontrak()
    {
        return $this->belongsTo(KontrakPerkuliahan::class, 'kontrak_id');
    }

    public function tracking()
    {
        return $this->hasMany(TrackingCapaian::class, 'pertemuan_id');
    }
}