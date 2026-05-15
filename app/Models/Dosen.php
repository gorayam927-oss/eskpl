<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';

    protected $fillable = [
        'user_id',
        'prodi_id',
        'nidn',
        'nama_lengkap',
        'no_hp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'dosen_id');
    }

    public function rps()
    {
        return $this->hasMany(Rps::class, 'dosen_id');
    }

    public function kontrakPerkuliahan()
    {
        return $this->hasMany(KontrakPerkuliahan::class, 'dosen_id');
    }

    public function getNamaDosenAttribute()
    {
        return $this->nama_lengkap
            ?? $this->user->name
            ?? 'Dosen ID: ' . $this->id;
    }
}