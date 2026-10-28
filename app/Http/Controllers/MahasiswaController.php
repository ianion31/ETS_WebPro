<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\JalurMasuk;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::with('jalurMasuk')->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    public function create()
    {
        $jalurMasuks = JalurMasuk::all();
        return view('mahasiswa.create', compact('jalurMasuks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nrp' => 'required|string|max:20|unique:mahasiswas',
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'jalur_masuk_id' => 'required|exists:jalur_masuks,id',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil ditambahkan.');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $jalurMasuks = JalurMasuk::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'jalurMasuks'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nrp' => 'required|string|max:20|unique:mahasiswas,nrp,' . $mahasiswa->id,
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'jalur_masuk_id' => 'required|exists:jalur_masuks,id',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus.');
    }
}