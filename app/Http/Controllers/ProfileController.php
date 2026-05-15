<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $prodi = Prodi::orderBy('nama_prodi')->get();

        if ($user->role === 'dosen') {
            $user->load('dosen.prodi');
        }

        if ($user->role === 'mahasiswa') {
            $user->load('mahasiswa.prodi');
        }

        return view('profile.index', [
            'user' => $user,
            'prodi' => $prodi,
            'title' => 'Profil Saya',
            'pageTitle' => 'Profil Saya',
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ];

        if ($user->role === 'dosen') {
            $rules = array_merge($rules, [
                'nidn' => [
                    'nullable',
                    'string',
                    'max:100',
                    Rule::unique('dosen', 'nidn')->ignore(optional($user->dosen)->id),
                ],
                'prodi_id' => ['nullable', 'exists:prodi,id'],
                'no_hp' => ['nullable', 'string', 'max:20'],
                'alamat' => ['nullable', 'string', 'max:500'],
            ]);
        }

        if ($user->role === 'mahasiswa') {
            $rules = array_merge($rules, [
                'nim' => [
                    'nullable',
                    'string',
                    'max:100',
                    Rule::unique('mahasiswa', 'nim')->ignore(optional($user->mahasiswa)->id),
                ],
                'prodi_id' => ['nullable', 'exists:prodi,id'],
                'angkatan' => ['nullable', 'string', 'max:20'],
                'no_hp' => ['nullable', 'string', 'max:20'],
                'alamat' => ['nullable', 'string', 'max:500'],
            ]);
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = strtolower($request->email);

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = $request->file('foto')->store('profile', 'public');
        }

        $user->save();

        if ($user->role === 'dosen') {
            $dosen = $user->dosen;

            if ($dosen) {
                $data = [
                    'prodi_id' => $request->prodi_id,
                    'nidn' => $request->nidn ?? $dosen->nidn,
                    'no_hp' => $request->no_hp,
                ];

                if (Schema::hasColumn('dosen', 'nama')) {
                    $data['nama'] = $request->name;
                }

                if (Schema::hasColumn('dosen', 'nama_lengkap')) {
                    $data['nama_lengkap'] = $request->name;
                }

                if (Schema::hasColumn('dosen', 'alamat')) {
                    $data['alamat'] = $request->alamat;
                }

                $dosen->update($data);
            }
        }

        if ($user->role === 'mahasiswa') {
            $mahasiswa = $user->mahasiswa;

            if ($mahasiswa) {
                $data = [
                    'prodi_id' => $request->prodi_id,
                    'nim' => $request->nim ?? $mahasiswa->nim,
                    'angkatan' => $request->angkatan,
                ];

                if (Schema::hasColumn('mahasiswa', 'nama')) {
                    $data['nama'] = $request->name;
                }

                if (Schema::hasColumn('mahasiswa', 'nama_lengkap')) {
                    $data['nama_lengkap'] = $request->name;
                }

                if (Schema::hasColumn('mahasiswa', 'no_hp')) {
                    $data['no_hp'] = $request->no_hp;
                }

                if (Schema::hasColumn('mahasiswa', 'alamat')) {
                    $data['alamat'] = $request->alamat;
                }

                $mahasiswa->update($data);
            }
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function deleteFoto()
    {
        $user = Auth::user();

        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->foto = null;
        $user->save();

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }
}