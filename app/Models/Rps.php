<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rps extends Model
{
    protected $table = 'rps';

    protected $fillable = [
        'dosen_id',
        'mata_kuliah_id',
        'judul',
        'file_rps',
        'status',
        'catatan',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class);
    }
}