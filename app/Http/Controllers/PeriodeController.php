<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{

    public function index(Request $request){
        // Get the search query from the request
        $query = $request->input('search');
    
        // Filter users based on the search query
        $data = Periode::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nama_periode', 'like', "%$query%")
                                ->orWhere('nama_periode', 'like', "%$query%")
                                ->orWhere('created_at', 'like', "%$query%")
                                ->orWhere('updated_at', 'like', "%$query%");
            })->get();
    
            // Count the number of users
            $jumlah_periode = Periode::count();
    
            // Return the view with filtered data
            return view('periode.periode', compact('data', 'jumlah_periode'));
        }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        return view('periode.create');
    }


// Menyimpan periode baru
public function store(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nama_periode' => 'required|unique:periodes,nama_periode',
        'tgl_mulai' => 'required|unique:periodes,tgl_mulai',
        'tgl_selesai' => 'required|unique:periodes,tgl_selesai',
    ], [
        'nama_periode.unique' => 'Nama Periode ini sudah terdaftar. Silakan pilih nama lain.',
        'tgl_mulai.unique' => 'Nama Periode ini sudah terdaftar. Silakan pilih nama lain.',
        'tgl_selesai.unique' => 'Nama Periode ini sudah terdaftar. Silakan pilih nama lain.'
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Menyimpan data periode
    try {
        Periode::create([
            'nama_periode' => $request->nama_periode,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
        ]);

        session()->flash('success', 'Periode berhasil ditambahkan!');
    } catch (\Exception $e) {
        session()->flash('error', 'Gagal menambahkan Periode. Silakan coba lagi!');
    }

    return redirect()->route('admin.periode');
}

// Menampilkan form untuk mengedit periode
 // Menampilkan form edit periode
 public function edit($id_periode)
 {
     $data = Periode::find($id_periode);
     
     if (!$data) {
         return redirect()->route('admin.periode.index')->with('error', 'Periode tidak ditemukan.');
     }
     
     return view('periode.edit', compact('data'));
 }

 // Update data periode
 public function update(Request $request, $id_periode)
    {
        // Mencari periode berdasarkan ID
        $periode = Periode::find($id_periode);
        
        if (!$periode) {
            return redirect()->route('admin.periode')->with('error', 'Periode tidak ditemukan.');
        }

        // Cek jika data tidak berubah
        if ($periode->nama_periode === $request->nama_periode &&
            $periode->tgl_mulai === $request->tgl_mulai &&
            $periode->tgl_selesai === $request->tgl_selesai) {
            return redirect()->route('admin.periode', $id_periode)->with('success', 'Tidak ada perubahan data.');
        }

        // Validasi data input untuk mengecek unique kecuali pada data saat ini
        $request->validate([
            'nama_periode' => 'required|unique:periodes,nama_periode,' . $id_periode . ',id_periode',
            'tgl_mulai' => 'required|unique:periodes,tgl_mulai,' . $id_periode . ',id_periode',
            'tgl_selesai' => 'required|unique:periodes,tgl_selesai,' . $id_periode . ',id_periode',
        ], [
            'nama_periode.unique' => 'Nama Periode ini sudah terdaftar. Silakan pilih nama lain.',
            'tgl_mulai.unique' => 'Tanggal Mulai ini sudah terdaftar. Silakan pilih tanggal lain.',
            'tgl_selesai.unique' => 'Tanggal Selesai ini sudah terdaftar. Silakan pilih tanggal lain.',
        ]);

        // Update data periode jika ada perubahan
        $periode->nama_periode = $request->nama_periode;
        $periode->tgl_mulai = $request->tgl_mulai;
        $periode->tgl_selesai = $request->tgl_selesai;
        $periode->save();

        return redirect()->route('admin.periode')->with('success', 'Periode berhasil diperbarui.');
    }



    public function hapus(Request $request, $id_periode){
        $data = Periode::find($id_periode);

        if ($data) {
            $data->delete();
            // Mengirimkan session success jika penghapusan berhasil
            return redirect()->route('admin.periode')->with('success', 'Data user berhasil dihapus');
        }

        // Mengirimkan session error jika data tidak ditemukan
        return redirect()->route('admin.periode')->with('error', 'Data user tidak ditemukan');
    }

    public function getPeriodeById($id_periode)
    {
        // Get the Periode by ID
        $periode = Periode::find($id_periode);

        // Return a response (JSON or view as required)
        if ($periode) {
            return response()->json(['periode' => $periode]);
        } else {
            return response()->json(['error' => 'Periode not found'], 404);
        }
    }

}

