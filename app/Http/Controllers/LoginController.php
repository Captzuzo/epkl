<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    use HasRoles;

    // Method untuk menampilkan halaman login
    public function index()
    {
        return view('auth.login'); // Pastikan 'auth.login' adalah view login yang ada
    }

    // Method untuk memproses login
    public function login_proses(Request $request)
{
    // Validasi input
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Ambil kredensial dari request
    $data = $request->only('username', 'password');

    // Cek login dengan kredensial
    if (Auth::attempt($data)) {
         // Ambil user yang sudah login
         $user = Auth::user();

         // Simpan nama pengguna ke session
         session(['nama' => $user->nama]);

         // Ambil role pengguna setelah berhasil login
         $roles = $user->getRoleNames();  // Mengambil semua role yang dimiliki oleh pengguna
 
         // Menyimpan role ke dalam session atau menampilkannya
         session(['user_roles' => $roles]);

        if ($user->hasRole('koordinator_pkl')) {
            return redirect()->route('admin.dashboardAdmin')->with('success', 'Login Berhasil');
        }

        if ($user->hasRole('siswa')) {
            return redirect()->route('dashboardSiswa');  // Pastikan nama rutenya benar
        }

        if ($user->hasRole('pembimbing')) {
            return redirect()->route('admin.dashboardPembimbing');
        }

        // Jika tidak ada peran yang cocok, logout dan tampilkan pesan error
        Auth::logout();
        return redirect()->route('login')->with('failed', 'Tidak memiliki akses yang sah.');
    }

    // Jika login gagal, arahkan kembali ke halaman login dengan pesan error
    return redirect()->route('login')->with('failed', 'Username atau password salah.');
}

    
public function logout(Request $request)
{
    // Ambil user yang sudah login
    $user = Auth::user();

    // Simpan nama pengguna ke session sebelum logout
    session()->put('nama', $user->nama);

    // Cek apakah nama disimpan di session
    // dd(session()->all()); // Cek seluruh data session

    // Logout user
    Auth::logout();

    // Invalidate the session
    $request->session()->invalidate();

    // Regenerate the session token to prevent session fixation attacks
    $request->session()->regenerateToken();

    // Redirect to the login page with a success message
    return redirect()->route('login')->with('success', 'Kamu berhasil logout!');
}


}
