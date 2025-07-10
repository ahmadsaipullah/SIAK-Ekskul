<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\profileController;
use App\Http\Controllers\Admin\EskulController;
use App\Http\Controllers\Siswa\NilaiEskulController;
use App\Http\Controllers\Siswa\SiswaEskulController;
use App\Http\Controllers\Siswa\JadwalEskulController;
use App\Http\Controllers\Siswa\AbsensiEskulController;
use App\Http\Controllers\Admin\CarouselEskulController;
use App\Http\Controllers\Pelatih\PelatihEskulController;
use App\Http\Controllers\Pelatih\PelatihNilaiController;
use App\Http\Controllers\Pelatih\PelatihPertemuanController;
use App\Http\Controllers\Admin\{adminController,dashboardController};
use App\Http\Controllers\Pelatih\PelatihAbsensiController;

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

require __DIR__.'/auth.php';

Route::get('/error-page', [dashboardController::class,'error'])->name('error');

Route::group(['middleware' => 'auth', 'PreventBackHistory'], function () {

// dashboard
Route::get('/', [dashboardController::class, 'index'])->name('dashboard');

// profile
Route::get('/profile/{encryptedId}/edit' ,[profileController::class, 'index'])->name('profile.index');
Route::put('/profile/password-update' ,[profileController::class, 'updatePassword'])->name('profile.updatePassword');
Route::put('/profile/{id}' ,[profileController::class, 'update'])->name('profile.update');



Route::middleware(['Admin'])->group( function(){

    // crud admin
    Route::resource('/admin', adminController::class);
    // crud carousel
    Route::resource('carousel', CarouselEskulController::class);
    // crud eskul
    Route::resource('eskul', EskulController::class);



});
Route::middleware(['PelatihEskul'])->group( function(){


    Route::get('pelatih-eskul', [PelatihEskulController::class, 'index'])->name('pelatih.eskul.index');
    Route::post('pelatih/eskul/{eskul}/approve/{user}', [PelatihEskulController::class, 'approve'])->name('pelatih.eskul.approve');
    Route::post('pelatih/eskul/{eskul}/reject/{user}', [PelatihEskulController::class, 'reject'])->name('pelatih.eskul.reject');


    Route::get('pelatih-eskul/{id}/siswa', [PelatihEskulController::class, 'siswa'])->name('pelatih.eskul.siswa');
    Route::post('pelatih-eskul/{id}/siswa/{userId}/approve', [PelatihEskulController::class, 'approve'])->name('pelatih.eskul.approve');
    Route::post('pelatih-eskul/{id}/siswa/{userId}/reject', [PelatihEskulController::class, 'reject'])->name('pelatih.eskul.reject');

    // Resource untuk pertemuan
    Route::resource('pertemuan', PelatihPertemuanController::class)->only(['index', 'create', 'store', 'edit', 'update']);


    // Tambahan: edit & update jumlah pertemuan eskul
    Route::get('pertemuan/{id}/edit-jumlah', [PelatihPertemuanController::class, 'editJumlah'])->name('pertemuan.edit.jumlah');
    Route::put('pertemuan/{id}/update-jumlah', [PelatihPertemuanController::class, 'updateJumlah'])->name('pertemuan.update.jumlah');

    // Pelatih
    Route::get('pelatih-nilai', [PelatihNilaiController::class, 'index'])->name('pelatih.nilai.index');
    Route::post('pelatih-nilai/store', [PelatihNilaiController::class, 'store'])->name('pelatih.nilai.store');
    Route::get('pelatih-nilai/{id}/edit', [PelatihNilaiController::class, 'edit'])->name('pelatih.nilai.edit');
    Route::put('pelatih-nilai/{id}', [PelatihNilaiController::class, 'update'])->name('pelatih.nilai.update');
    Route::delete('pelatih-nilai/{id}', [PelatihNilaiController::class, 'destroy'])->name('pelatih.nilai.destroy');

    // absensi
    Route::get('pelatih-absensi', [PelatihAbsensiController::class, 'index'])->name('pelatih.absensi.index');





});
Route::middleware(['WaliKelas'])->group( function(){



});
Route::middleware(['Siswa'])->group( function(){

    // Route Daftar Eskul
    Route::get('siswa-eskul', [SiswaEskulController::class, 'index'])->name('siswa.eskul.index');
    Route::get('siswa-eskul/{id}', [SiswaEskulController::class, 'show'])->name('siswa.eskul.show');
    Route::post('siswa-eskul/{id}/daftar', [SiswaEskulController::class, 'daftar'])->name('siswa.eskul.daftar');
    // jadwal
    Route::get('siswa-jadwal', [JadwalEskulController::class, 'index'])->name('siswa.jadwal.index');
    Route::get('siswa-jadwal/{id}', [JadwalEskulController::class, 'show'])->name('siswa.jadwal.show');
    // absensi
    Route::get('siswa-absensi', [AbsensiEskulController::class, 'index'])->name('siswa.absensi.index');
    Route::post('/siswa/absensi/{id}', [AbsensiEskulController::class, 'store'])->name('siswa.absensi.store');

    // nilai
    Route::get('siswa-nilai', [NilaiEskulController::class, 'index'])->name('siswa.nilai.index');



});







});

