<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'prodi_id',
        'kode_mk',
        'nama_mk',
        'sks',
        'semester',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'mata_kuliah_id');
    }

    public function rps()
    {
        return $this->hasMany(Rps::class, 'mata_kuliah_id');
    }

    public function kontrakPerkuliahan()
    {
        return $this->hasMany(KontrakPerkuliahan::class, 'mata_kuliah_id');
    }
}