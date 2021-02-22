<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KamarController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\KamarSewaController;
use App\Http\Controllers\Web\FasilitasController;
use App\Http\Controllers\Web\PindahKamarController;

use App\Http\Controllers\Web\PemeliharaanController;
use App\Http\Controllers\Web\PerawatanController;
use App\Http\Controllers\Web\TambahAsetController;
use App\Http\Controllers\Web\PembayaranController;
use App\Http\Controllers\Web\TagihanController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::resource('kamar',KamarController::class);
Route::resource('penyewa',PenyewaController::class);
Route::resource('fasilitas',FasilitasController::class);
Route::resource('m_aset',AsetController::class);
Route::resource('kamar_sewa',KamarSewaController::class);
Route::resource('pindah_kamar',PindahKamarController::class);
Route::resource('pemeliharaan',PemeliharaanController::class);
Route::resource('perawatan',PerawatanController::class);
Route::resource('t_aset',TambahAsetController::class);
Route::resource('pembayaran',PembayaranController::class);
Route::resource('tagihan',TagihanController::class);
Route::get('daftar_bayar',[PembayaranController::class,'df_bayar'])->name('df.bayar');


Route::get('create_fasilitas/{kamar_id}',[FasilitasController::class,'kamar_selected'])->name('fasilitas.kamar.terpilih');