<?php

namespace App\Http\Controllers;

use App\Models\JalurMasuk;
use Illuminate\Http\Request;

class JalurMasukController extends Controller
{
    public function index()
    {
        $jalur = JalurMasuk::all();
        return view('jalur_masuk.index', compact('jalur'));
    }

    public function create()
    {
        return view('jalur_masuk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:100',
        ]);

        JalurMasuk::create([
            'nama_jalur' => $request->nama_jalur,
        ]);

        return redirect()->route('jalur-masuk.index')->with('success', 'Jalur Masuk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jalur = JalurMasuk::findOrFail($id);
        return view('jalur_masuk.edit', compact('jalur'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jalur' => 'required|string|max:100',
        ]);

        $jalur = JalurMasuk::findOrFail($id);
        $jalur->update([
            'nama_jalur' => $request->nama_jalur,
        ]);

        return redirect()->route('jalur-masuk.index')->with('success', 'Jalur Masuk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jalur = JalurMasuk::findOrFail($id);
        $jalur->delete();

        return redirect()->route('jalur-masuk.index')->with('success', 'Jalur Masuk berhasil dihapus!');
    }
}