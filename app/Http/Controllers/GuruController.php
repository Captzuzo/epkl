<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Pembimbing;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class GuruController extends Controller
{
    public function guru(Request $request){
        // Get the search query from the request
        $query = $request->input('search');
    
        // Filter users based on the search query
        $data = Guru::when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('nip', 'like', "%$query%")
                                ->orWhere('nip', 'like', "%$query%")
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
            $jumlah_guru = Guru::count();

            // Mengambil data siswa beserta relasi 'jurusan'
            $data = Siswa::with(['jurusan', 'periode'])->get();
            $jurusan = Jurusan::all(); // Mengambil semua jurusan (untuk kebutuhan lainnya)

            // Return the view with filtered data
            
            return view('guru.guru', compact('data', 'jumlah_guru' , 'jurusan'));
        }

        // Menampilkan form untuk membuat user baru
    public function create()
    {

        $jurusans = Jurusan::all(); // Ambil semua data jurusan

        return view('guru.create', compact('periodes', 'jurusans'));
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
         // Membuat username otomatis berdasarkan NIS
         $username = $request->nis;

         // Password otomatis menggunakan NIS (sebaiknya di-hash untuk keamanan)
         $password = Hash::make($request->nis); // bcrypt akan dijalankan otomatis oleh Hash::make

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Menyimpan data pembimbing ke dalam database
        try {
            // Menyimpan data pembimbing ke tabel Pembimbing
            Guru::create([
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'email' => $request->email, // Fix this from $request->kelas to $request->email
                'id_jurusan' => $request->id_jurusan,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'ttl' => $request->ttl,
                'no_telp' => $request->no_telp,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            // Menyimpan data user ke tabel Users
            User::create([
                'nis' => 0,
                'nip' => $request->nip,  // Assign nip here
                'nama' => $request->nama_guru, // Sesuaikan dengan nama pembimbing
                'no_telp' => $request->no_telp,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'hak_akses' => 'pembimbing',  // Hak akses otomatis 'pembimbing'
            ]);

            session()->flash('success', 'Pembimbing berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Menampilkan pesan error jika terjadi exception
            session()->flash('error', 'Gagal menambahkan pembimbing. Silakan coba lagi! Error: ' . $e->getMessage());
        }

        return redirect()->route('admin.guru');
    }


        // Menampilkan form untuk mengedit user
        public function edit($nis)
        {
            $data = Pembimbing::find($nis);
            return view('pembimbing.edit', compact('data'));
        }

    // Mengupdate data user
    public function update(Request $request, $nip)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:12',
            'nama_guru' => 'required',
            'email' => 'required|email', // Pastikan format email valid
            'id_jurusan' => 'required',
            'no_telp' => 'required|string', // Pastikan no_telp valid
            'username' => 'required',
            'password' => 'required|min:8', // Password minimal 8 karakter
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Menyimpan data siswa
        $data = [
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'email' => $request->email,
            'id_jurusan' => $request->id_jurusan,
            'no_telp' => $request->no_telp,
            'username' => $request->username,
        ];

        // Jika password diubah
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // Mengupdate data siswa berdasarkan nis
        Guru::where('nip', $nip)->update($data);

        return redirect()->route('admin.pembimbing');
    }

    public function hapus(Request $request, $nip){
        $data = Guru::find($nip);

        if ($data) {
            $data->delete();
            // Mengirimkan session success jika penghapusan berhasil
            return redirect()->route('admin.guru')->with('success', 'Data pembimbing berhasil dihapus');
        }

        // Mengirimkan session error jika data tidak ditemukan
        return redirect()->route('admin.guru')->with('error', 'Data pembimbing tidak ditemukan');
    }


}
