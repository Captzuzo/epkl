<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Guru;
use App\Models\Pembimbing;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class PembimbingController extends Controller
{
    public function index(Request $request){
        // Get the search query from the request
        $query = $request->input('search');
    
        // Filter users based on the search query
        $data = Pembimbing::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nip', 'like', "%$query%")
                                ->orWhere('nama_guru', 'like', "%$query%")
                                ->orWhere('email', 'like', "%$query%")
                                ->orWhere('id_jurusan', 'like', "%$query%")
                                ->orWhere('no_telp', 'like', "%$query%")
                                ->orWhere('username', 'like', "%$query%")
                                ->orWhere('password', 'like', "%$query%")
                                ->orWhere('created_at', 'like', "%$query%")
                                ->orWhere('updated_at', 'like', "%$query%");
            })->get();
    
            // Count the number of users
            $jumlah_guru = Pembimbing::count();

            // Mengambil data siswa beserta relasi 'jurusan'
            $pembimbing = Pembimbing::with(['jurusan'])->get();
            $jurusan = Jurusan::all(); // Mengambil semua jurusan (untuk kebutuhan lainnya)

            // Return the view with filtered data
            
            return view('pembimbing.pembimbing', compact('data', 'jumlah_guru' , 'jurusan'));
        }

        // Menampilkan form untuk membuat user baru
        public function create()
        {
            // Ambil semua data roles
            $roles = Role::all(); // Pastikan model Role sudah diimport
            $jurusans = Jurusan::all(); // Ambil semua data jurusan
    
            return view('pembimbing.create', compact('jurusans','roles'));
        }

    public function store(Request $request){
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:12',
            'nama_guru' => 'required',
            'email' => 'required|email', // Pastikan format email valid
            'id_jurusan' => 'required',
            'no_telp' => 'required|string', // Pastikan no_telp valid

        ]);

        // Menampilkan data request yang divalidasi sebelum username dan password dibuat
        // dd($request->all());

        // Membuat username otomatis berdasarkan NIP
        $username = $request->nip;

        // Password otomatis menggunakan NIP (sebaiknya di-hash untuk keamanan)
        $password = Hash::make($request->nip); // bcrypt akan dijalankan otomatis oleh Hash::make

        // Menampilkan username dan password untuk memverifikasi hasilnya
        // dd($username, $password);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Menyimpan data pembimbing ke dalam database
        try {
            // Menyimpan data pembimbing ke tabel Pembimbing
            Pembimbing::create([
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'email' => $request->email, // Fix this from $request->kelas to $request->email
                'id_jurusan' => $request->id_jurusan,
                'no_telp' => $request->no_telp,
                'username' => $username,
                'password' => $password,
            ]);

            // Menyimpan data user ke tabel Users
            $data = User::create([
                'nis' => 0,
                'nip' => $request->nip,  // Kosongkan NIP untuk siswa
                'nama' => $request->nama_guru, // Sesuaikan dengan nama siswa
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'username' => $username,  // Gunakan username otomatis
                'password' => $password,  // Gunakan password otomatis
            ]);
             // Assign role ke user
             $data->assignRole($request->role);

            session()->flash('success', 'Pembimbing berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Menampilkan pesan error jika terjadi exception
            session()->flash('error', 'Gagal menambahkan pembimbing. Silakan coba lagi! Error: ' . $e->getMessage());
        }

        return redirect()->route('admin.pembimbing');
    }

    // Menampilkan form untuk mengedit user
    public function edit($nip)
    {
        $data = Pembimbing::find($nip);
        $jurusans = Jurusan::all();
        // Ambil semua data roles
        $roles = Role::all(); // Pastikan model Role sudah diimport
        return view('pembimbing.edit', compact('data', 'jurusans', 'roles'));
    }

    // Mengupdate data user
    public function update(Request $request, $nip)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            // 'nip' => 'required|string|max:12',
            'nama_guru' => 'required',
            'email' => 'required|email', // Pastikan format email valid
            'id_jurusan' => 'required',
            'no_telp' => 'required|string', // Pastikan no_telp valid
            // 'username' => 'required',
            // 'password' => 'required|min:8', // Password minimal 8 karakter
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Menyimpan data siswa
        $data = [
            // 'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'email' => $request->email,
            'id_jurusan' => $request->id_jurusan,
            'no_telp' => $request->no_telp,
            // 'username' => $request->username,
        ];

        // // Jika password diubah
        // if ($request->password) {
        //     $data['password'] = Hash::make($request->password);
        // }

        // Mengupdate data siswa berdasarkan nis
        Pembimbing::where('nip', $nip)->update($data);

        return redirect()->route('admin.pembimbing')->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function hapus(Request $request, $nip){
        $data = Pembimbing::find($nip);

        if ($data) {
            $data->delete();
            // Mengirimkan session success jika penghapusan berhasil
            return redirect()->route('admin.pembimbing')->with('success', 'Data pembimbing berhasil dihapus');
        }

        // Mengirimkan session error jika data tidak ditemukan
        return redirect()->route('admin.pembimbing')->with('error', 'Data pembimbing tidak ditemukan');
    }

}
