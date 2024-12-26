<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pembagian;
use App\Models\Pembimbing;
use App\Models\Pengajuan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PembagianController extends Controller
{
     // Fungsi untuk menampilkan form pembagian pembimbing
     public function create()
    {
        // Ambil siswa yang pengajuannya disetujui dan belum mendapatkan pembimbing
        $siswaBelumDibimbing = Siswa::leftJoin('pembagians', 'siswas.nis', '=', 'pembagians.nis')
                                    ->whereNull('pembagians.nis')
                                    ->select('siswas.*')
                                    ->get();

        // Ambil pembimbing yang belum mencapai kuota 5 siswa
        $pembimbing = Pembimbing::withCount('pembagians')  // Menghitung jumlah siswa yang dibimbing
                                ->having('pembagians_count', '<', 5) // Pembimbing dengan kurang dari 5 siswa
                                ->get();

        return view('pembagian.create', compact('siswaBelumDibimbing', 'pembimbing'));
    }
 
     // Fungsi untuk menyimpan pembagian pembimbing
     public function store(Request $request)
     {
         $validated = $request->validate([
             'nis' => 'required|exists:siswas,nis',
             'nip' => 'required|exists:pembimbings,nip',
         ]);
 
         // Cek apakah pembimbing sudah memiliki maksimal 5 siswa
         $pembimbing = Pembimbing::find($validated['nip']);
         if ($pembimbing->pembagians()->count() >= 5) {
             return redirect()->back()->with('error', 'Pembimbing sudah memiliki maksimal 5 siswa.');
         }
 
         // Assign pembimbing ke siswa
         Pembagian::create([
             'nis' => $validated['nis'],
             'nip' => $validated['nip'],
             'id_pengajuan' => Pengajuan::where('nis', $validated['nis'])->first()->id_pengajuan,
         ]);
 
         return redirect()->route('pembagian.index')->with('success', 'Pembimbing berhasil dibagikan.');
     }    
}
