<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\AsetController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\KamarSewaController;
use App\Http\Controllers\Web\FasilitasController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('/penyewa', [App\Http\Controllers\PenyewaController::class, 'index'])->penyewa('penyewa');

Route::resource('kamar',KamarController::class);
Route::resource('aset',AsetController::class);
Route::resource('penyewa',PenyewaController::class);
Route::resource('fasilitas',FasilitasController::class);
Route::resource('kamar_sewa',KamarSewaController::class);

