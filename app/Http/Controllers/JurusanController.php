<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanController extends Controller
{
    public function index(Request $request){
        // Get the search query from the request
        $query = $request->input('search');
    
        // Filter users based on the search query
        $data = Jurusan::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nama_jurusan', 'like', "%$query%")
                                ->orWhere('nama_jurusan', 'like', "%$query%")
                                ->orWhere('created_at', 'like', "%$query%")
                                ->orWhere('updated_at', 'like', "%$query%");
            })->get();
    
            // Count the number of users
            $jumlah_jurusan= Jurusan::count();
    
            // Return the view with filtered data
            return view('jurusan.jurusan', compact('data', 'jumlah_jurusan'));
        }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        // Validasi input dengan menambahkan aturan unique untuk nama_jurusan
        $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan',
        ], [
            'nama_jurusan.unique' => 'Nama jurusan ini sudah terdaftar. Silakan pilih nama lain.'
        ]);

        try {
            // Simpan data jurusan ke database
            $jurusan = new Jurusan();
            $jurusan->nama_jurusan = $request->input('nama_jurusan');
            $jurusan->save();

            // Kirim session success
            return redirect()->route('admin.jurusan')->with('success', 'Jurusan berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Kirim session error jika terjadi kesalahan
            return redirect()->route('admin.jurusan')->with('error', 'Terjadi kesalahan, coba lagi.');
        }
    }




    // Menampilkan form untuk mengedit user
    public function edit($id_jurusan)
    {
        $data = Jurusan::find($id_jurusan);
        return view('jurusan.edit', compact('data'));
    }

    // Mengupdate data user
    public function update(Request $request, $id_jurusan)
{
    // Validasi input dengan aturan unique untuk nama_jurusan kecuali untuk record yang sedang di-update
    $request->validate([
        'nama_jurusan' => 'required|string|max:255|unique:jurusans,nama_jurusan,' . $id_jurusan . ',id_jurusan',
    ], [
        'nama_jurusan.unique' => 'Nama jurusan ini sudah terdaftar. Silakan pilih nama lain.'
    ]);

    // Menyimpan data jurusan yang sudah divalidasi
    $data = [
        'nama_jurusan' => $request->input('nama_jurusan'),
    ];

    // Mengupdate data jurusan berdasarkan ID
    Jurusan::where('id_jurusan', $id_jurusan)->update($data);

    // Redirect ke halaman admin.jurusan dengan pesan sukses
    return redirect()->route('admin.jurusan')->with('success', 'Jurusan berhasil diperbarui!');
}


    public function hapus(Request $request, $id_jurusan){
        $data = Jurusan::find($id_jurusan);

        if ($data) {
            $data->delete();
            // Mengirimkan session success jika penghapusan berhasil
            return redirect()->route('admin.jurusan')->with('success', 'Data Jurusan berhasil dihapus');
        }

        // Mengirimkan session error jika data tidak ditemukan
        return redirect()->route('admin.jurusan')->with('error', 'Data Jurusan tidak ditemukan');
    }
}
