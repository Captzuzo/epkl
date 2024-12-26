<?php

use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\SiswaController;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HashPermissionController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\ModelHasRolesController;
use App\Http\Controllers\PembagianController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PengajuanSiswaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleHasPermissionController;
use App\Http\Controllers\RolePermissionController;
use App\Models\Pengajuan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     // return view('welcome');
//     echo "Helo World";
// });
Route::get('/', function () {
    return redirect()->route('login'); // Mengarahkan root URL ke halaman login
});

// Route::group(['middleware' => ['role:koordinator_pkl']], function () {
//     // Semua route di sini hanya bisa diakses oleh user dengan role 'admin' atau 'editor'
//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login-proses',[LoginController::class,'login_proses'])->name('login-proses');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

//Permission 
Route::resource('permissions', PermissionController::class);

// Group Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function() {
    // Dashboard for Admin (Koordinator PKL)
    Route::get('/dashboard-admin', [HomeController::class, 'dashboardAdmin'])->name('dashboardAdmin') ;

    // // Dashboard for Pembimbing
    Route::get('/dashboard-pembimbing', [HomeController::class, 'dashboardPembimbing'])->name('dashboardPembimbing')->middleware('role:pembimbing');


    // Manajemen Role
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');  // Ubah ke 'index'
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{role_id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/update/{role_id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/hapus/{role_id}', [RoleController::class, 'hapus'])->name('roles.hapus');

    //Manajemen Role Permission
    Route::get('/rolepermissions', [RolePermissionController::class, 'index'])->name('rolepermissions'); 
    Route::get('/rolepermissions/create', [RolePermissionController::class, 'create'])->name('rolepermissions.create'); 
    Route::get('/rolepermissions/store', [RolePermissionController::class, 'store'])->name('rolepermissions.store'); 
    Route::get('/rolepermissions/edit', [RolePermissionController::class, 'edit'])->name('rolepermissions.edit'); 
    Route::get('/rolepermissions/hapus', [RolePermissionController::class, 'hapus'])->name('rolepermissions.hapus'); 
   
    // Manajemen rolehash
    Route::get('/rolehash', [RoleHasPermissionController::class, 'index'])->name('rolehash');  // Daftar role
    Route::get('/rolehash/create', [RoleHasPermissionController::class, 'create'])->name('rolehash.create'); 
    Route::get('/rolehash/store', [RoleHasPermissionController::class, 'store'])->name('rolehash.store'); 
    Route::get('/rolehash/{role_id}/permissions', [RoleHasPermissionController::class, 'edit'])->name('rolehash.edit'); // Edit permissions
    Route::put('/rolehash/{role_id}/permissions', [RoleHasPermissionController::class, 'update'])->name('rolehash.update'); // Update permissions
    
    // Manajemen rolehash
    Route::get('/rolehash', [RoleHasPermissionController::class, 'index'])->name('rolehash');  // Daftar role
    Route::get('/rolehash/create', [RoleHasPermissionController::class, 'create'])->name('rolehash.create'); 
    Route::get('/rolehash/store', [RoleHasPermissionController::class, 'store'])->name('rolehash.store'); 
    Route::get('/rolehash/{role_id}/permissions', [RoleHasPermissionController::class, 'edit'])->name('rolehash.edit'); // Edit permissions
    Route::put('/rolehash/{role_id}/permissions', [RoleHasPermissionController::class, 'update'])->name('rolehash.update'); // Update permissions
    Route::delete('/rolehash/{role_id}', [RoleHasPermissionController::class, 'destroy'])->name('rolehash.destroy');
    
    // Model Has Roles Management Routes
    Route::get('/modelhasroles', [ModelHasRolesController::class, 'index'])->name('modelhasroles.index'); // List all assignments
    Route::get('/modelhasroles/create', [ModelHasRolesController::class, 'create'])->name('modelhasroles.create'); // Show form to assign role
    Route::post('/modelhasroles', [ModelHasRolesController::class, 'store'])->name('modelhasroles.store'); // Store new assignment
    Route::get('/modelhasroles/{role_id}/edit', [ModelHasRolesController::class, 'edit'])->name('modelhasroles.edit'); // Show form to edit assignment
    Route::put('/modelhasroles/{role_id}', [ModelHasRolesController::class, 'update'])->name('modelhasroles.update'); // Update role assignment
    Route::delete('/modelhasroles/{role_id}', [ModelHasRolesController::class, 'destroy'])->name('modelhasroles.destroy'); // Delete assignment
    
    // Model Has Permission Management Routes
    Route::get('/hashPermissions', [HashPermissionController::class, 'index'])->name('hashPermissions'); // List all assignments
    Route::get('/hashPermissions/create', [HashPermissionController::class, 'create'])->name('hashPermissions.create'); // Show form to assign role
    Route::post('/hashPermissions', [HashPermissionController::class, 'store'])->name('hashPermissions.store'); // Store new assignment
    Route::get('/hashPermissions/{permission_id}/edit', [HashPermissionController::class, 'edit'])->name('hashPermissions.edit'); // Show form to edit assignment
    Route::put('/hashPermissions/{permission_id}', [HashPermissionController::class, 'update'])->name('hashPermissions.update'); // Update role assignment
    Route::delete('/hashPermissions/{permission_id}', [HashPermissionController::class, 'destroy'])->name('hashPermissions.destroy'); // Delete assignment

    
    // Manajemen User
    Route::get('/user', [UserController::class, 'index'])->name('user');  // Ubah 'user' ke 'index'
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/hapus/{id}', [UserController::class, 'hapus'])->name('user.hapus');

    // Manajemen Periode
    Route::get('/periode', [PeriodeController::class, 'index'])->name('periode');// Ubah ke 'index'
    Route::get('/periode/create', [PeriodeController::class, 'create'])->name('periode.create');
    Route::post('/periode/store', [PeriodeController::class, 'store'])->name('periode.store');
    Route::get('/periode/edit/{id_periode}', [PeriodeController::class, 'edit'])->name('periode.edit');
    Route::put('/periode/update/{id_periode}', [PeriodeController::class, 'update'])->name('periode.update');
    Route::delete('/periode/hapus/{id_periode}', [PeriodeController::class, 'hapus'])->name('periode.hapus');
    
    // Manajemen Jurusan
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan')->middleware('role_or_permission:koordinator_pkl,view_jurusan');  // Ubah ke 'index'
    Route::get('/jurusan/create', [JurusanController::class, 'create'])->name('jurusan.create')->middleware('role_or_permission:koordinator_pkl,view_jurusan');
    Route::post('/jurusan/store', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::get('/jurusan/edit/{id_jurusan}', [JurusanController::class, 'edit'])->name('jurusan.edit');
    Route::put('/jurusan/update/{id_jurusan}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/hapus/{id_jurusan}', [JurusanController::class, 'hapus'])->name('jurusan.hapus');
    
    // Manajemen Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');  // Ubah ke 'index'
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
    Route::get('/siswa/edit/{nis}', [SiswaController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/update/{nis}', [SiswaController::class, 'update'])->name('siswa.update');
    Route::delete('/siswa/hapus/{nis}', [SiswaController::class, 'hapus'])->name('siswa.hapus');
    
    // Manajemen Guru (Pembimbing)
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');  // Ubah ke 'index'
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::post('/guru/store', [GuruController::class, 'store'])->name('guru.store');
    Route::get('/guru/edit/{nip}', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/update/{nip}', [GuruController::class, 'update'])->name('guru.update');
    Route::delete('/guru/hapus/{nip}', [GuruController::class, 'hapus'])->name('guru.hapus');

    // Manajemen Pembimbing
    Route::get('/pembimbing', [PembimbingController::class, 'index'])->name('pembimbing');
    Route::get('/pembimbing/create', [PembimbingController::class, 'create'])->name('pembimbing.create');
    Route::post('/pembimbing/store', [PembimbingController::class, 'store'])->name('pembimbing.store');
    Route::get('/pembimbing/edit/{nip}', [PembimbingController::class, 'edit'])->name('pembimbing.edit');
    Route::put('/pembimbing/update/{nip}', [PembimbingController::class, 'update'])->name('pembimbing.update');
    Route::delete('/pembimbing/hapus/{nip}', [PembimbingController::class, 'hapus'])->name('pembimbing.hapus');

    // Manajemen Instansi
    Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi');  // Ubah 'user' ke 'index'
    Route::get('/instansi/create', [InstansiController::class, 'create'])->name('instansi.create');
    Route::post('/instansi/store', [InstansiController::class, 'store'])->name('instansi.store');
    Route::get('/instansi/edit/{id_instansi}', [InstansiController::class, 'edit'])->name('instansi.edit');
    Route::put('/instansi/update/{id_instansi}', [InstansiController::class, 'update'])->name('instansi.update');
    Route::delete('/instansi/hapus/{id_instansi}', [InstansiController::class, 'hapus'])->name('instansi.hapus');
    Route::delete('/instansi/hapus/{id_instansi}', [InstansiController::class, 'hapus'])->name('instansi.hapus');
    
    // Manajemen Pengajuan
    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::get('pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('pengajuan/{id}/edit', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::put('pengajuan/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::delete('pengajuan/{id}', [PengajuanController::class, 'hapus'])->name('pengajuan.hapus');
    Route::post('pengajuan/{id}/setujui', [PengajuanController::class, 'setujui'])->name('pengajuan.setujui');
    Route::post('pengajuan/{id}/tolak', [PengajuanController::class, 'tolak'])->name('pengajuan.tolak');
    Route::get('pengajuan/{id}/surat', [PengajuanController::class, 'surat'])->name('pengajuan.surat');
    Route::get('pengajuan/get-siswa/{jurusanId}', [PengajuanController::class, 'getSiswaByJurusan'])->name('.pengajuan.getSiswaByJurusan');
    // AJAX route to get students by jurusan
    Route::get('get-siswa-by-jurusan', [PengajuanController::class, 'getSiswaByJurusan'])->name('getSiswaByJurusan');

    // Routes untuk Pembagian
    Route::get('/pembagian', [PembagianController::class, 'index'])->name('pembagian');
    Route::post('/pembagian/store', [PembagianController::class, 'store'])->name('pembagian.store');
    Route::get('/pembagian/create', [PembagianController::class, 'create'])->name('pembagian.create');
    Route::delete('/pembagian/{id_pembagian}', [PembagianController::class, 'destroy'])->name('pembagian.destroy');
});

// Menambahkan route untuk siswa dashboard
// Route::middleware(['auth', 'role:siswa'])->get('/dashboard-siswa', [DashboardController::class, 'dashboardSiswa'])->name('dashboardSiswa');

// Group Pembimbing
// Route::group(['prefix' => 'pembimbing', 'middleware' => ['auth', 'role:pembimbing'], 'as' => 'pembimbing.'], function() {
//     Route::get('/dashboard-pembimbing', [DashboardController::class, 'dashboardPembimbing'])->name('dashboardPembimbing');
// });


// Rute untuk siswa, hanya dapat melihat dan membuat pengajuan yang terkait dengan dirinya
Route::group(['prefix' => 'siswa', 'middleware' => ['auth'], 'as' => 'siswa.'], function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboardSiswa'])->name('dashboardSiswa');
    //pengajuan siswa

    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/get-siswa-by-jurusan', [PengajuanController::class, 'getSiswaByJurusan'])->name('get.siswa.by.jurusan');
    Route::get('/get-periode/{id_periode}', [PengajuanController::class, 'getPeriodeById'])->name('get.periode.by.id');
});



