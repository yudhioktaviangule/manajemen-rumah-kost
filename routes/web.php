<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KamarController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\KamarSewaController;
use App\Http\Controllers\Web\FasilitasController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('kamar',KamarController::class);
Route::resource('penyewa',PenyewaController::class);

Route::resource('fasilitas',FasilitasController::class);
Route::resource('kamar_sewa',KamarSewaController::class);