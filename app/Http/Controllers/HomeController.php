<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Jurusan;
use App\Models\Pembimbing;
use App\Models\Pengajuan;
use App\Models\Periode;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['role:koordinator_pkl']);
    //     return  abort(403, 'Unauthorized Access');
    // }

    // Halaman Dashboard
    // public function dashboard()
    // {
    //     return view('dashboard');

        
    // }

    public function dashboardAdmin() {
        // dd(auth()->user()->getRoleNames());
        $data = User::all();
        $data = Periode::all();
        $data = Jurusan::all();

    $jumlah_user = User::count();
    $jumlah_periode = Periode::count();
    $jumlah_jurusan = Jurusan::count();
    $jumlah_siswa = Siswa::count();
    $jumlah_pembimbing = Pembimbing::count();
    $jumlah_instansi = Instansi::count();
    $jumlah_pengajuan = Pengajuan::count();
    // return abort(403);
    return view('dashboardAdmin', compact('data', 'jumlah_user', 'jumlah_periode', 'jumlah_jurusan', 'jumlah_siswa', 'jumlah_pembimbing', 'jumlah_instansi', 'jumlah_pengajuan'));
    }

    public function dashboardSiswa()
    {
        // Return the siswa (student) dashboard view
        return view('dashboardSiswa');
        // return abort(403);
    }

    public function dashboardPembimbing()
    {
        // Return the pembimbing (supervisor) dashboard view
        return view('dashboardPembimbing');
        return abort(403);
    }

    // public function guru() {
    //     // Logika untuk guru
    //     return view('dashboard-guru');
    // }

    // public function siswa() {
    //     // Logika untuk siswa
    //     return view('dashboard-siswa');
    // }

    // Menampilkan semua data user
    public function index()
    {
        // Mengambil semua data pengguna dari database
        $data = User::all();

        // Menghitung jumlah pengguna dari database
        $jumlah_user = User::count();
        $jumlah_periode = Periode::count();

        // Mengirimkan data pengguna dan jumlah pengguna ke view
        return view('index', compact('data', 'jumlah_user', 'jumlah_periode'));
    }

    // public function user(Request $request){
    // // Get the search query from the request
    // $query = $request->input('search');

    // // Filter users based on the search query
    // $data = User::when($query, function ($queryBuilder) use ($query) {
    //     return $queryBuilder->where('nis', 'like', "%$query%")
    //                         ->orWhere('nip', 'like', "%$query%")
    //                         ->orWhere('nama', 'like', "%$query%")
    //                         ->orWhere('no_telp', 'like', "%$query%")
    //                         ->orWhere('email', 'like', "%$query%")
    //                         ->orWhere('username', 'like', "%$query%")
    //                         ->orWhere('created_at', 'like', "%$query%")
    //                         ->orWhere('updated_at', 'like', "%$query%");
    //     })->get();

    //     // Count the number of users
    //     $jumlah_user = User::count();

    //     // Return the view with filtered data
    //     return view('user.user', compact('data', 'jumlah_user'));
    // }

    public function periode(Request $request){
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
    // public function createUser()
    // {
    //     return view('user.createUser');
    // }

    public function createPeriode()
    {
        return view('periode.createPeriode');
    }

    

    

    public function storeUser(Request $request) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nis' => 'required',
            'nip' => 'required',
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'hak_akses' => 'required',
        ]);
    
        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    
        // Menyiapkan data
        $data = [
            'nis' => $request->nis,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hak_akses' => $request->hak_akses,
        ];
    
        // Menyimpan data user
        try {
            User::create($data);
    
            // Flash session untuk pesan berhasil
            session()->flash('success', 'User berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Flash session untuk pesan gagal
            session()->flash('error', 'Gagal menambahkan user. Silakan coba lagi!');
        }
    
        return redirect()->route('admin.user');
    }
    

    public function storePeriode(Request $request){
        $validator = Validator::make ($request->all(),[
         'nama_periode' => 'required',
         'tgl_mulai' => 'required',
         'tgl_selesai' => 'required',
        ]);
 
        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
 
        $data['nama_periode'] = $request->nama_periode;
        $data['tgl_mulai'] = $request->tgl_mulai;
        $data['tgl_selesai'] = $request->tgl_selesai;
 
        User::create($data);
        return redirect()->route('admin.periode');
        
     }

    public function edit(Request $request, $user_id){
        $data = User::find($user_id);
        return view('user.editUser', compact('data'));
    }

    public function update(Request $request, $user_id){
        $validator = Validator::make ($request->all(),[
            'nis' => 'required',
            'nip' => 'required',
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'hak_akses' => 'required',
           ]);
    
           if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
    
           $data['nis'] = $request->nis;
           $data['nip'] = $request->nip;
           $data['nama'] = $request->nama;
           $data['no_telp'] = $request->no_telp;
           $data['email'] = $request->email;
           $data['username'] = $request->username;
           if($request->password){
                $data['password'] = Hash::make($request->password);
           }
           
           $data['hak_akses'] = $request->hak_akses;
    
           User::whereUser_id($user_id)->update($data);
           return redirect()->route('admin.user');
    }

    public function hapus(Request $request, $user_id){
        $data = User::find($user_id);

        if ($data) {
            $data->delete();
            // Mengirimkan session success jika penghapusan berhasil
            return redirect()->route('admin.user')->with('success', 'Data user berhasil dihapus');
        }

        // Mengirimkan session error jika data tidak ditemukan
        return redirect()->route('admin.user')->with('error', 'Data user tidak ditemukan');
    }

    

}
