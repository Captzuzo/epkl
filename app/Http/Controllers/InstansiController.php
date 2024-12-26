<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    // Menampilkan daftar instansi
    public function index()
    {
        $instansis = Instansi::all();  // Ambil semua data instansi
        return view('instansi.instansi', compact('instansis'));
    }

    // Menampilkan form untuk menambah instansi baru
    public function create()
    {
        $instansi = Instansi::all();
        return view('instansi.create', compact('instansi'));
    }

    // Menyimpan instansi baru
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|numeric',
            'kota' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Menyimpan data user
        $data = Instansi::create([
            'nama_instansi' => $request->nama_instansi,
            'alamat' => 0,  // Kosongkan NIP untuk siswa
            'no_telp' => $request->no_telp, // Sesuaikan dengan nama siswa
            'no_telp' => $request->no_telp,
            'kota' => $request->kota,
            'latitude' => $latitude,  // Gunakan username otomatis
            'longitude' => $longitude,  // Gunakan password otomatis
        ]);

        Instansi::create($request->all());

        return redirect()->route('admin.instansi')->with('success', 'Instansi berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit instansi
    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);  // Ambil instansi berdasarkan ID
        return view('instansi.edit', compact('instansi'));
    }

    // Mengupdate data instansi
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'kota' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $instansi = Instansi::findOrFail($id);
        $instansi->update($request->all());

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil diperbarui');
    }

    // Menghapus data instansi
    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil dihapus');
    }
}
