<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Periode;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class SiswaController extends Controller
{

    public function __construct()
    {
        // Middleware untuk membatasi akses berdasarkan role
        $this->middleware('role:koordinator_pkl')->only('dashboardAdmin');
        $this->middleware('role:siswa')->only('dashboardSiswa');
        $this->middleware('role:pembimbing')->only('dashboardPembimbing');
    }

    public function index(Request $request){
        // Get the search query from the request
        $query = $request->input('search');
    
        // Filter users based on the search query
        $data = Siswa::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nis', 'like', "%$query%")
                                ->orWhere('nis', 'like', "%$query%")
                                ->orWhere('nama_siswa', 'like', "%$query%")
                                ->orWhere('kelas', 'like', "%$query%")
                                ->orWhere('id_periode', 'like', "%$query%")
                                ->orWhere('id_jurusan', 'like', "%$query%")
                                ->orWhere('alamat', 'like', "%$query%")
                                ->orWhere('kota', 'like', "%$query%")
                                ->orWhere('ttl', 'like', "%$query%")
                                ->orWhere('no_telp', 'like', "%$query%")
                                ->orWhere('email', 'like', "%$query%")
                                ->orWhere('username', 'like', "%$query%")
                                ->orWhere('password', 'like', "%$query%")
                                ->orWhere('created_at', 'like', "%$query%")
                                ->orWhere('updated_at', 'like', "%$query%");
            })->get();
    
            // Count the number of users
            $jumlah_siswa = Siswa::count();

            // Mengambil data siswa beserta relasi 'jurusan' dan 'periode'
            $data = Siswa::with(['jurusan', 'periode'])->get();
            $periode = Periode::all(); // Mengambil semua periode (untuk kebutuhan lainnya)
            $jurusan = Jurusan::all(); // Mengambil semua jurusan (untuk kebutuhan lainnya)
            // Return the view with filtered data
            
            return view('siswa.siswa', compact('data', 'jumlah_siswa' , 'periode', 'jurusan'));
        }


    // Menampilkan form untuk membuat user baru
    public function create()
    {

        $periodes = Periode::all(); // Ambil semua data periode
        $jurusans = Jurusan::all(); // Ambil semua data jurusan
        $roles = Role::all(); // Ambil semua role yang ada
        return view('siswa.create', compact('periodes', 'jurusans','roles'));
    }

    // Menyimpan siswa dan user baru
    public function store(Request $request)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'nis' => 'required|string|max:11',
        'nama_siswa' => 'required',
        'kelas' => 'required',
        'id_periode' => 'required',
        'id_jurusan' => 'required',
        'alamat' => 'required',
        'kota' => 'required',
        'ttl' => 'required|date',
        'no_telp' => 'required|string',
        'email' => 'required|email',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Membuat username otomatis berdasarkan NIS
    $username = $request->nis;
    $password = Hash::make($request->nis); // Menggunakan NIS untuk password

    try {
        // Menyimpan data siswa
        $siswa = Siswa::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'id_periode' => $request->id_periode,
            'id_jurusan' => $request->id_jurusan,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'ttl' => $request->ttl,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'username' => $username,  // Gunakan username otomatis
            'password' => $password,  // Gunakan password otomatis
        ]);

        // Menyimpan data user
        $user = User::create([
            'nis' => $request->nis,
            'nip' => 0,  // Kosongkan NIP untuk siswa
            'nama' => $request->nama_siswa, // Sesuaikan dengan nama siswa
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'username' => $username,  // Gunakan username otomatis
            'password' => $password,  // Gunakan password otomatis
        ]);

        // Pastikan role 'siswa' sudah ada
        $role = Role::firstOrCreate(['name' => 'siswa']);

        // Menambahkan role "siswa" pada user yang baru dibuat
        if ($role) {
            $user->assignRole($role);  // Memberikan role kepada user
        }

        session()->flash('success', 'Siswa berhasil ditambahkan!');
    } catch (\Exception $e) {
        session()->flash('error', 'Gagal menambahkan siswa. Silakan coba lagi! Error: ' . $e->getMessage());
    }

    return redirect()->route('admin.siswa');
}

    
    

    // Menampilkan form untuk mengedit user
    public function edit($nis)
    {
        $data = Siswa::findOrFail($nis); // Mengambil data siswa berdasarkan NIS
        $periodes = Periode::all(); // Mengambil semua data periode
        $jurusans = Jurusan::all(); // Mengambil semua data jurusan
        $users = User::all(); // Mengambil semua data user

        return view('siswa.edit', compact('data', 'periodes', 'jurusans','users'));

    }

    // Mengupdate data user
    public function update(Request $request, $nis)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            // 'nis' => 'required',
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'id_periode' => 'required',
            'id_jurusan' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'ttl' => 'required',
            'no_telp' => 'required',
            'email' => 'required|Email',
            // 'username' => 'required',
            // 'password' => 'nullable',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Menyimpan data siswa
        $data = [
            // 'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'id_periode' => $request->id_periode,
            'id_jurusan' => $request->id_jurusan,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'ttl' => $request->ttl,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            // 'username' => $request->username,
        ];

        // // Jika password diubah
        // if ($request->password) {
        //     $data['password'] = Hash::make($request->password);
        // }

        // Mengupdate data siswa berdasarkan nis
        Siswa::where('nis', $nis)->update($data);

        return redirect()->route('admin.siswa');
    }

    public function hapus(Request $request, $nis){
        $data = Siswa::find($nis);

        if ($data) {
            $data->delete();
            // Mengirimkan session success jika penghapusan berhasil
            return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil dihapus');
        }

        // Mengirimkan session error jika data tidak ditemukan
        return redirect()->route('admin.siswa')->with('error', 'Data siswa tidak ditemukan');
    }


    // Menghapus data siswa
    public function destroy($nis)
    {
    
        $data = Siswa::find($nis);

        if ($data) {
            $data->delete();
            return redirect()->route('admin.siswa')->with('success', 'Data siswa berhasil dihapus');
        }

        return redirect()->route('admin.siswa')->with('error', 'Data siswa tidak ditemukan');
    }
}

