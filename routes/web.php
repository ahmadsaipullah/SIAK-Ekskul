<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\profileController;
use App\Http\Controllers\Admin\EskulController;
use App\Http\Controllers\Admin\CarouselEskulController;
use App\Http\Controllers\Admin\{adminController,dashboardController};


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



});
Route::middleware(['WaliKelas'])->group( function(){



});
Route::middleware(['Siswa'])->group( function(){



});







});

