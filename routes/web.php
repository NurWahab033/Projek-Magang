<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FormulirPendaftaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanHarianController;
use App\Http\Controllers\CheckClockController;
use App\Http\Controllers\LaporanAkhirController;
use App\Http\Controllers\DetailUserController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PicController;

//form login
Route::get('/login', function () {
    return view('kredensial/login');
})->name('login');

Route::get('/', function () {
    return view('kredensial/login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
Route::post('/register', [RegisterController::class, 'register']);

//PESERTA
Route::middleware(['auth', 'peserta'])->group(function () {
    //laman peserta
    Route::get('/peserta', function () {return view('peserta/lamanpeserta');});
    //presensi
    Route::get('/presensi', [CheckClockController::class, 'index'])->name('checkclock.index');
    Route::post('/presensi', [CheckClockController::class, 'store'])->name('checkclock.store');
    //laporanharian
    Route::get('/laporan', [LaporanHarianController::class, 'index'])->name('laporan.index');
    Route::post('/laporan', [LaporanHarianController::class, 'store'])->name('laporan.store');
    Route::get('/laporan/{id}', [LaporanHarianController::class, 'show'])->name('laporan.show');
    Route::put('/laporan/{id}', [LaporanHarianController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id}', [LaporanHarianController::class, 'destroy'])->name('laporan.destroy');
    Route::post('/update-photo', [App\Http\Controllers\DetailUserController::class, 'updatePhoto'])->name('updatePhoto');
    Route::post('/update-unit/{user}', [DetailUserController::class, 'updateUnit'])->name('update.unit');
    //laporanakhir
    Route::resource('Laporan-Akhir', LaporanAkhirController::class)->middleware('auth');
    //Sertifikat
    Route::get('/sertifikat', function () {return view('peserta/cetaksertifikat');});
    Route::get('/sertif', function () {return view('peserta/sertifikat');});
});

//ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    //laman admin
    Route::get('/admin', function () { return view('admin/lamanadmin');});
    //detailakun
    Route::get('/detailakun', [AdminController::class, 'detailAkun'])->name('detailAkun');
    Route::get('/create-pic', [AdminController::class, 'createPic'])->name('createPic');
    Route::post('/store-pic', [AdminController::class, 'storePic'])->name('storePic');
    Route::post('/reset-password-pic', [AdminController::class, 'resetPasswordPic'])->name('resetPasswordPic');
    Route::put('/formpendaftaran/{id}/status', [AdminController::class, 'updateStatus'])->name('formpendaftaran.updateStatus');
    //verifikasi
    Route::get('/verifikasi', [AdminController::class, 'index']);
    //monitoring
    Route::get('/monitoring', [MonitoringController::class, 'index'])->name('monitoring.index');
    Route::post('/monitoring/{id}/update-unit', [MonitoringController::class, 'updateUnit'])->name('update.unit');
    Route::delete('/monitoring/{id}/hapus-unit', [MonitoringController::class, 'deleteUnit'])->name('delete.unit');
    //sertifikasi
    Route::get('/sertifikasi', function () {return view('admin/sertifikasipeserta');});
});

//USER 
Route::middleware(['auth', 'user'])->group(function () {
    //lamanuser
    Route::get('/user', function () {return view('user/lamanuser');})->name('user.dashboard');
    //formpendaftaran
    Route::get('/formpendaftaran', [FormulirPendaftaranController::class, 'create'])->name('formulir.create');
    Route::post('/formpendaftaran', [FormulirPendaftaranController::class, 'store'])->name('formulir.store');
    Route::post('/update-photo', [App\Http\Controllers\DetailUserController::class, 'updatePhoto'])->name('updatePhoto');
    Route::post('/update-unit/{user}', [DetailUserController::class, 'updateUnit'])->name('update.unit');
    Route::get('/informasi', [AdminController::class, 'informasi'])->middleware('auth');
});

//PIC
Route::middleware(['auth', 'pic'])->group(function () {
    Route::get('/PIC', [App\Http\Controllers\PicController::class, 'index'])->name('pic.dashboard');
    Route::post('/pic/penilaian/{user_id}', [PicController::class, 'storePenilaian'])->name('penilaian.store');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/update-photo', [DetailUserController::class, 'updatePhoto'])->name('updatePhoto');
});

