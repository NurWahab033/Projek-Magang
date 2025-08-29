<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FormulirPendaftaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\DetailUserController;

Route::get('/', function () {
    return view('welcome');
});

//form login
Route::get('/login', function () {
    return view('kredensial/login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//form register
// Route::get('/register', function () {
//     return view('kredensial/register');
// });

Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/formulir', [FormulirPendaftaranController::class, 'create']);
// Route::post('/formulir', [FormulirPendaftaranController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/formpendaftaran', [FormulirPendaftaranController::class, 'create'])->name('formulir.create');
    Route::post('/formpendaftaran', [FormulirPendaftaranController::class, 'store'])->name('formulir.store');
    Route::put('/formpendaftaran/{id}/status', [AdminController::class, 'updateStatus'])
    ->name('formpendaftaran.updateStatus');
    Route::get('/verifikasi',[AdminController::class, 'index']);
    Route::post('/update-photo', [App\Http\Controllers\DetailUserController::class, 'updatePhoto'])->name('updatePhoto');

});

//Laporan Harian
Route::middleware(['auth'])->group(function () {
    Route::get('/laporan', [LaporanHarianController::class, 'index'])->name('laporan.index');
    Route::post('/laporan', [LaporanHarianController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}', [LaporanHarianController::class, 'show'])->name('laporan.show');
    Route::put('/laporan/{id}', [LaporanHarianController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id}', [LaporanHarianController::class, 'destroy'])->name('laporan.destroy');
});
//form forgot pass
Route::get('/forgotpassword', function () {
    return view('kredensial/resetpass');
});

//USER
//lamanuser
Route::get('/user', function () {
    return view('user/lamanuser');
});

Route::get('/formpendaftaranpeserta', function () {
    return view('user/formpendaftaran');
});
// // form peserta magang
// Route::get('/formpendaftaran', function () {
//     return view('user/magangform');
// });

//form informasi pendaftaran
// Route::get('/informasi', function () {
//     return view('user/informasi');
// });
Route::get('/informasi', [AdminController::class, 'informasi'])->middleware('auth');

//ADMIN
//laman admin
Route::get('/admin', function () {
    return view('admin/lamanadmin');
});

Route::get('/sertifikasi', function () {
    return view('admin/sertifikasipeserta');
});

//form verifikasi peserta
// Route::get('/verifikasi', function () {
//     return view('admin/verifikasipeserta');
// });

//form detail peserta
Route::get('/detailakun', function () {
    return view('admin/detailakun');
});

//form monitoring peserta
Route::get('/monitoring', function () {
    return view('admin/monitoringpeserta');
});

//PESERTA
//laman peserta
Route::get('/peserta', function () {
    return view('peserta/lamanpeserta');
});

//Edit profile
Route::get('/edit_profile', function () {
    return view('peserta/editprofil');
});

//Presensi
Route::get('/Presensi-Peserta', function () {
    return view('peserta/presensipeserta');
});

//Laporan Harian
// Route::get('/Laporan-Harian', function () {
//     return view('peserta/laporanharian');
// });

//Laporan Akhir
Route::get('/Laporan-Akhir', function () {
    return view('peserta/laporanakhir');
});

Route::get('/sertifikat', function () {
    return view('peserta/cetaksertifikat');
});

Route::get('/sertif', function () {
    return view('peserta/sertifikat');
});

//Laman PIC
use App\Http\Controllers\PenilaianController;
Route::get('/penilaian', function () {
    return view('PIC/penilaian');
});

Route::get('/pic', function () {
    return view('PIC/lamanpic');
});

Route::get('/detailpesertapic', function () {
    return view('PIC/detailpeserta_pic');
});


