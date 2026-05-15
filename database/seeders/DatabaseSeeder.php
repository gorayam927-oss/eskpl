<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator E-SKPL',
            'email' => 'admin@eskpl.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $prodi = Prodi::create([
            'kode_prodi' => 'TI',
            'nama_prodi' => 'Teknik Informatika',
            'fakultas' => 'Fakultas Ilmu Komputer',
        ]);

        $userDosen = User::create([
            'name' => 'Dosen Demo',
            'email' => 'dosen@eskpl.test',
            'password' => Hash::make('password'),
            'role' => 'dosen',
            'is_active' => true,
        ]);

        $dosen = Dosen::create([
            'user_id' => $userDosen->id,
            'prodi_id' => $prodi->id,
            'nidn' => '0123456789',
            'nama_lengkap' => 'Dosen Demo, M.Kom',
            'no_hp' => '081234567890',
            'alamat' => 'Kampus Utama',
        ]);

        $userMahasiswa = User::create([
            'name' => 'Mahasiswa Demo',
            'email' => 'mahasiswa@eskpl.test',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
            'is_active' => true,
        ]);

        Mahasiswa::create([
            'user_id' => $userMahasiswa->id,
            'prodi_id' => $prodi->id,
            'nim' => '20240001',
            'nama_lengkap' => 'Mahasiswa Demo',
            'angkatan' => '2024',
            'no_hp' => '081111111111',
            'alamat' => 'Alamat Mahasiswa',
        ]);

        $mataKuliah = MataKuliah::create([
            'prodi_id' => $prodi->id,
            'kode_mk' => 'IF101',
            'nama_mk' => 'Pemrograman Web',
            'sks' => 3,
            'semester' => 4,
        ]);

        Kelas::create([
            'mata_kuliah_id' => $mataKuliah->id,
            'dosen_id' => $dosen->id,
            'nama_kelas' => 'TI-4A',
            'tahun_akademik' => '2025/2026',
            'semester_aktif' => 'genap',
            'hari' => 'Senin',
            'jam_mulai' => '08:00',
            'jam_selesai' => '10:30',
            'ruangan' => 'Lab Komputer 1',
        ]);
    }
}