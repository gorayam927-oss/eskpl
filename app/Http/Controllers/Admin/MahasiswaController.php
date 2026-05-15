<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $mahasiswa = Mahasiswa::with(['user', 'prodi'])
            ->latest()
            ->paginate(10);

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('admin.mahasiswa.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
            'nim' => ['required', 'unique:mahasiswa,nim'],
            'nama_lengkap' => ['required', 'max:150'],
            'angkatan' => ['nullable', 'max:10'],
            'no_hp' => ['nullable', 'max:20'],
            'alamat' => ['nullable'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
            'is_active' => true,
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'prodi_id' => $request->prodi_id,
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'angkatan' => $request->angkatan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $mahasiswa->load(['user', 'prodi']);

        return view('admin.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('admin.mahasiswa.edit', compact('mahasiswa', 'prodi'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $mahasiswa->user_id],
            'password' => ['nullable', 'min:6'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
            'nim' => ['required', 'unique:mahasiswa,nim,' . $mahasiswa->id],
            'nama_lengkap' => ['required', 'max:150'],
            'angkatan' => ['nullable', 'max:10'],
            'no_hp' => ['nullable', 'max:20'],
            'alamat' => ['nullable'],
        ]);

        $mahasiswa->user->update([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => $request->password
                ? Hash::make($request->password)
                : $mahasiswa->user->password,
        ]);

        $mahasiswa->update([
            'prodi_id' => $request->prodi_id,
            'nim' => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'angkatan' => $request->angkatan,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $mahasiswa->user()->delete();

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}