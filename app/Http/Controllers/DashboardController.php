<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pembimbing;
use App\Models\Periode;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class DashboardController extends Controller
{
    use HasRoles;
    public function dashboardAdmin()
    {
        if (Auth::check() && Auth::user()->hasRole('koordinator_pkl')) {
            $jumlah_user = User::count();         // Menghitung jumlah user
        $jumlah_periode = Periode::count();   // Menghitung jumlah periode
        $jumlah_jurusan = Jurusan::count();   // Menghitung jumlah jurusan
        $jumlah_siswa = Siswa::count();       // Menghitung jumlah siswa
        $jumlah_pembimbing = Pembimbing::count();       // Menghitung jumlah siswa

        $user = Auth::user();

        if ($user->hasRole('koordinator_pkl')) {
            return view('admin.dashboard');
        }

        abort(403, 'Unauthorized action.');
        // return view('admin.dashboardAdmin', compact('jumlah_user', 'jumlah_periode', 'jumlah_jurusan', 'jumlah_siswa'));
        // // return view('dashboardAdmin');
        //     // return view('admin.dashboard');
        }
        
    }

    public function dashboardPembimbing()
    {
        // Logika untuk dashboard pembimbing
        return view('dashboardPembimbing'); // Ganti dengan tampilan dashboard pembimbing Anda
    }

    // Method untuk menampilkan dashboard siswa
    public function dashboardSiswa()
    {
        return view('siswa.dashboardSiswa');  // Mengarahkan ke view dashboard siswa
    }
}
