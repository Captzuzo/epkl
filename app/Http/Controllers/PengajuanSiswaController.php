<?php

namespace App\Http\Controllers;

// use App\Models\Pengajuan;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Instansi;
use App\Models\PengajuanSiswa;
use App\Models\Periode;
use Illuminate\Http\Request;

class PengajuanSiswaController extends Controller
{
    // Fungsi untuk menampilkan data pengajuan
    public function index()
    {
        $pengajuans = PengajuanSiswa::with(['siswa', 'jurusan', 'instansi', 'periode'])->get();
        return view('siswa.pengajuan', compact('pengajuans'));
    }

    // Fungsi untuk menampilkan form tambah pengajuan
    public function create()
    {
        $jurusans = Jurusan::all();
        $instansi = Instansi::all();
        $periodes = Periode::all();
        $siswas = Siswa::all();
        return view('pengajuan.create', compact('jurusans', 'instansi', 'periodes', 'siswas'));
    }

    // Fungsi untuk menyimpan data pengajuan
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
            'nis1' => 'required|exists:siswas,nis',
            'nis2' => 'nullable|exists:siswas,nis',
            'nis3' => 'nullable|exists:siswas,nis',
            'nis4' => 'nullable|exists:siswas,nis',
            'id_instansi' => 'required|exists:instansis,id_instansi',
            'id_periode' => 'required|exists:periodes,id_periode',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date',
        ]);

        // Menyimpan data pengajuan
        $data = [
            'nis' => $request->nis1,
            'id_jurusan' => $request->id_jurusan,
            'id_instansi' => $request->id_instansi,
            'id_periode' => $request->id_periode,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_selesai' => $request->tgl_selesai,
            'status' => 'menunggu',
        ];

        // Membuat pengajuan
        $pengajuan = PengajuanSiswa::create($data);

        // Menambahkan siswa tambahan jika ada
        if ($request->nis2) {
            $pengajuan->siswas()->attach($request->nis2);
        }
        if ($request->nis3) {
            $pengajuan->siswas()->attach($request->nis3);
        }
        if ($request->nis4) {
            $pengajuan->siswas()->attach($request->nis4);
        }

        return redirect()->route('admin.pengajuan')->with('success', 'Pengajuan berhasil ditambahkan.');
    }

    // Fungsi untuk mencetak surat pengajuan
    public function cetakSurat($id_pengajuan)
    {
        try {
            $pengajuan = PengajuanSiswa::with(['siswa', 'jurusan', 'instansi'])->findOrFail($id_pengajuan);
            $tanggal = date('Y-m-d');
            $hari = $this->getNamaHari(date('l', strtotime($tanggal)));
            $bulan = $this->getNamaBulan(date('n', strtotime($tanggal)));
            $tanggal_indo = date('j', strtotime($tanggal)) . ' ' . $bulan . ' ' . date('Y', strtotime($tanggal));

            return view('pengajuan.surat', compact('pengajuan', 'tanggal_indo'));
        } catch (\Exception $e) {
            return redirect()->route('admin.pengajuan')->with('error', 'Gagal mencetak surat: ' . $e->getMessage());
        }
    }

    private function getNamaBulan($bulan)
    {
        $bulanIndo = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        return $bulanIndo[$bulan];
    }

    private function getNamaHari($hari)
    {
        $hariIndo = [
            'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
        ];
        return $hariIndo[$hari];
    }

    // Fungsi untuk mendapatkan siswa berdasarkan jurusan
    public function getSiswaByJurusan(Request $request)
    {
        $siswas = Siswa::where('id_jurusan', $request->jurusan_id)->get();
        return response()->json(['siswas' => $siswas]);
    }

    // Fungsi untuk mendapatkan periode berdasarkan ID
    public function getPeriodeById($id_periode)
    {
        $periode = Periode::find($id_periode);
        if ($periode) {
            return response()->json(['periode' => $periode]);
        } else {
            return response()->json(['error' => 'Periode tidak ditemukan'], 404);
        }
    }
}
