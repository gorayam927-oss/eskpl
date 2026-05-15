<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpmk extends Model
{
    protected $table = 'cpmk';

    protected $fillable = [
        'kontrak_id',
        'kode_cpmk',
        'deskripsi',
        'bobot',
    ];

    public function kontrak()
    {
        return $this->belongsTo(KontrakPerkuliahan::class, 'kontrak_id');
    }

    public function tracking()
    {
        return $this->hasMany(TrackingCapaian::class, 'cpmk_id');
    }
}