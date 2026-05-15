<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $dosen = Dosen::with(['user', 'prodi'])->latest()->paginate(10);

        return view('admin.dosen.index', compact('dosen'));
    }

    public function create()
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('admin.dosen.create', compact('prodi'));
    }

    public function store(Request $request)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
            'nidn' => ['required', 'unique:dosen,nidn'],
            'nama_lengkap' => ['required', 'max:150'],
            'no_hp' => ['nullable', 'max:20'],
            'alamat' => ['nullable'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => Hash::make($request->password),
            'role' => 'dosen',
            'is_active' => true,
        ]);

        Dosen::create([
            'user_id' => $user->id,
            'prodi_id' => $request->prodi_id,
            'nidn' => $request->nidn,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $dosen->load(['user', 'prodi']);

        return view('admin.dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $prodi = Prodi::orderBy('nama_prodi')->get();

        return view('admin.dosen.edit', compact('dosen', 'prodi'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $request->validate([
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $dosen->user_id],
            'password' => ['nullable', 'min:6'],
            'prodi_id' => ['nullable', 'exists:prodi,id'],
            'nidn' => ['required', 'unique:dosen,nidn,' . $dosen->id],
            'nama_lengkap' => ['required', 'max:150'],
            'no_hp' => ['nullable', 'max:20'],
            'alamat' => ['nullable'],
        ]);

        $dosen->user->update([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'password' => $request->password ? Hash::make($request->password) : $dosen->user->password,
        ]);

        $dosen->update([
            'prodi_id' => $request->prodi_id,
            'nidn' => $request->nidn,
            'nama_lengkap' => $request->nama_lengkap,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        abort_if(auth()->user()->role !== 'admin', 403);

        $dosen->user()->delete();

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil dihapus.');
    }
}