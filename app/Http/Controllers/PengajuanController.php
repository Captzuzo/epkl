<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Jurusan;
use App\Models\Instansi;
use App\Models\Periode;
use App\Models\Siswa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    // Show list of Pengajuan
    public function index(Request $request)
    {
        $search = $request->get('search');
        $pengajuan = Pengajuan::with(['siswa', 'jurusan', 'instansi', 'periode'])
                              ->when($search, function ($query, $search) {
                                  return $query->where('status', 'like', "%$search%")
                                               ->orWhereHas('siswa', function ($query) use ($search) {
                                                   $query->where('nis', 'like', "%$search%")
                                                         ->orWhere('nama_siswa', 'like', "%$search%");
                                               });
                              })
                              ->get();

        return view('pengajuan.pengajuan', compact('pengajuan'));
    }

    public function create()
    {
        $instansis = Instansi::all(); // Fetch all companies
        $jurusans = Jurusan::all(); // Fetch all departments
        $periodes = Periode::all(); // Fetch all periods
        $siswas = Siswa::all(); // Fetch all students

        return view('pengajuan.create', compact('instansis', 'jurusans', 'periodes', 'siswas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $Validator = $request->validate([
            'id_instansi' => 'required|exists:instansi,id',
            'nis' => 'required|exists:siswas,nis',
            'id_jurusan' => 'required|exists:jurusan,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        if ($Validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }


    // Set status default jika tidak diberikan
    $status = $request->status ?? 'menunggu';

    // Simpan data pengajuan baru
    Pengajuan::create([
        'nis' => $request->nis,
        'id_jurusan' => $request->id_jurusan,
        'id_instansi' => $request->id_instansi,
        'id_periode' => $request->id_periode,
        'tgl_mulai' => $request->tgl_mulai,
        'tgl_selesai' => $request->tgl_selesai,
        'status' => $status,  // Gunakan status default jika kosong
    ]);

    // Redirect atau memberikan pesan sukses
    return redirect()->route('admin.pengajuan')->with('success', 'Pengajuan berhasil dibuat');
}

    // Show form for editing Pengajuan
    public function edit($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $jurusans = Jurusan::all();
        $instansis = Instansi::all();
        $periodes = Periode::all();

        return view('pengajuan.edit', compact('pengajuan', 'jurusans', 'instansis', 'periodes'));
    }

    // Update the Pengajuan
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'id_jurusan' => 'required|exists:jurusans,id',
            'id_instansi' => 'required|exists:instansis,id',
            'id_periode' => 'required|exists:periodes,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
            'status' => 'required',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->update($request->all());

        return redirect()->route('admin.pengajuan')->with('success', 'Pengajuan berhasil diperbarui.');
    }

    // Delete the Pengajuan
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('admin.pengajuan')->with('success', 'Pengajuan berhasil dihapus.');
    }

    public function getSiswaByJurusan($jurusanId)
    {
        $siswa = Siswa::where('id_jurusan', $jurusanId)->get();
        return response()->json(['siswa' => $siswa]);
    }
}
