<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Periode;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role; // Import Role dari Spatie

class UserController extends Controller
{
    // public function __construct()
    // {
    //     // Middleware untuk membatasi akses berdasarkan role
    //     $this->middleware('role:koordinator_pkl')->only('dashboardAdmin');
    //     $this->middleware('role:siswa')->only('dashboardSiswa');
    //     $this->middleware('role:pembimbing')->only('dashboardPembimbing');
    // }

    // Dashboard for Admin (Koordinator PKL)
    public function dashboardAdmin(){
        $jumlah_periode = Periode::count();
        $jumlah_user = User::count();
        return view('admin.dashboardAdmin', compact('jumlah_periode', 'jumlah_user'));
    }

    // Dashboard for Siswa
    public function dashboardSiswa()
    {
        return view('siswa.dashboard');
    }

    // Dashboard for Pembimbing
    public function dashboardPembimbing()
    {
        return view('pembimbing.dashboard');
    }

    // Menampilkan data user
    public function index(Request $request)
    {
        $query = $request->input('search');
        $data = User::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nis', 'like', "%$query%")
                                ->orWhere('nip', 'like', "%$query%")
                                ->orWhere('nama', 'like', "%$query%")
                                ->orWhere('no_telp', 'like', "%$query%")
                                ->orWhere('email', 'like', "%$query%")
                                ->orWhere('username', 'like', "%$query%")
                                ->orWhere('created_at', 'like', "%$query%")
                                ->orWhere('updated_at', 'like', "%$query%");
        })->get();

        $jumlah_user = User::count();
        return view('user.user', compact('data', 'jumlah_user'));
    }

    // Menampilkan form untuk membuat user baru
    public function create()
    {
        // Passing all available roles to the create view
        $roles = Role::all(); // Ambil semua role yang ada
        return view('user.create', compact('roles'));
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nis' => 'required|numeric',
            'nip' => 'nullable|numeric', // Optional for NIP
            'nama' => 'required|string|max:100|unique:users,nama',
            'no_telp' => 'required|numeric|unique:users,no_telp',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:4', // Password di-hash dan pastikan konfirmasi password sesuai
            'role' => 'required|exists:roles,name', // Pastikan role valid
        ], [
            'nama.unique' => 'Nama sudah terdaftar. Silakan pilih nama lain.',
            'no_telp.unique' => 'Nomor telepon sudah terdaftar.',
            'email.unique' => 'Email sudah terdaftar. Silakan pilih email lain.',
            'username.unique' => 'Username sudah terdaftar. Silakan pilih username lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Menyimpan data user
        try {
            $user = User::create([
                'nis' => $request->nis,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password), // Password di-hash
            ]);
            // Pastikan role 'siswa' sudah ada
        $role = Role::firstOrCreate(['name' => 'koordinator_pkl']);

        // Menambahkan role "siswa" pada user yang baru dibuat
        if ($role) {
            $user->assignRole($role);  // Memberikan role kepada user
        }


            session()->flash('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan user. Silakan coba lagi!');
        }

        return redirect()->route('admin.user');
    }

    // Menampilkan form untuk mengedit user
    public function edit(Request $request, $id)
{
    // Cari data user berdasarkan user_id
    $data = User::where('id',$id)->first();  // Me

    // Jika data user tidak ditemukan, alihkan ke halaman lain atau tampilkan error
    if (!$data) {
        return redirect()->route('admin.user')->with('error', 'User tidak ditemukan');
    }

    // Ambil semua data siswa dan roles
    $siswas = Siswa::all();
    $roles = Role::all(); // Ambil semua role untuk edit

    // Kirim data ke view 'admin.user.edit'
    return view('user.edit', compact('data', 'roles', 'siswas'));
}

// Mengupdate data user
public function update(Request $request, $id)
{
    // Cari data pengguna berdasarkan ID
    $user = User::find($id);

    // Jika user tidak ditemukan, kembalikan dengan error
    if (!$user) {
        session()->flash('error', 'User tidak ditemukan!');
        return redirect()->route('admin.user');
    }

    // Validasi input
    $validator = Validator::make($request->all(), [
        'nis' => 'required|numeric',
        'nip' => 'nullable|numeric', // Optional for NIP
        'nama' => 'required|string|max:100|unique:users,nama,' . $id,  // Exclude current user's name from unique validation
        'no_telp' => 'required|numeric|unique:users,no_telp,' . $id,   // Exclude current user's phone number from unique validation
        'email' => 'required|email|unique:users,email,' . $id,         // Exclude current user's email from unique validation
        'username' => 'nullable|unique:users,username,' . $id,         // Exclude current user's username from unique validation
        'password' => 'nullable', // Password di-hash dan pastikan konfirmasi password sesuai
        'role' => 'required|exists:roles,name', // Pastikan role valid
    ], [
        'nama.unique' => 'Nama sudah terdaftar. Silakan pilih nama lain.',
        'no_telp.unique' => 'Nomor telepon sudah terdaftar.',
        'email.unique' => 'Email sudah terdaftar. Silakan pilih email lain.',
        'username.unique' => 'Username sudah terdaftar. Silakan pilih username lain.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    // Jika validasi gagal
    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Mengecek apakah ada perubahan pada data
    $dataUser = [
        'nis' => $request->nis,
        'nip' => $request->nip,
        'nama' => $request->nama,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        'username' => $request->username,
    ];

    // Jika password diubah
    if ($request->password) {
        $dataUser['password'] = Hash::make($request->password); // Hash password
    }

    // Hanya lakukan update jika ada perubahan
    $isUpdated = false;
    foreach ($dataUser as $key => $value) {
        if ($user->$key != $value) {
            $isUpdated = true;
            break;
        }
    }

    // Jika tidak ada perubahan, beri pesan sukses tanpa melakukan update
    if (!$isUpdated) {
        session()->flash('success', 'Tidak ada perubahan data!');
        return redirect()->route('admin.user');
    }

    // Update data user
    $user->update($dataUser);

    // Sync roles (misalnya jika menggunakan spatie/laravel-permission)
    $user->syncRoles($request->role);

    // Berhasil update
    session()->flash('success', 'User dan data siswa berhasil diperbarui!');
    
    return redirect()->route('admin.user');
}

    // Menghapus data user
    public function hapus(Request $request, $id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('admin.user')->with('success', 'Data user berhasil dihapus');
        }

        return redirect()->route('admin.user')->with('error', 'Data user tidak ditemukan');
    }

    // Menghapus data user (destroy method)
    public function destroy($id)
    {
        $data = User::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('admin.user')->with('success', 'Data user berhasil dihapus');
        }

        return redirect()->route('admin.user')->with('error', 'Data user tidak ditemukan');
    }
}