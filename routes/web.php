<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\KamarController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\KamarSewaController;
use App\Http\Controllers\Web\FasilitasController;
use App\Http\Controllers\Web\PindahKamarController;
use App\Http\Controllers\Web\PembayaranController;
use App\Http\Controllers\Web\TagihanController;
use App\Http\Controllers\Web\PenyewaRegister;
use App\Http\Controllers\Web\ReservasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Web\PengeluaranController;
use App\Http\Controllers\Web\LaporanPengeluaran;
use App\Http\Controllers\Web\LaporanPemasukan;
use App\Http\Controllers\Web\LaporanController;
use App\Http\Controllers\Web\LanjutNgekostController;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Client\PenghuniPembayaranController;
use App\Http\Controllers\ErrController;
use App\Http\Controllers\HistPembayaranController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('kamar',KamarController::class);

Route::resource('penyewa',PenyewaController::class);
Route::resource('user',UserController::class);
Route::resource('fasilitas',FasilitasController::class);
Route::resource('m_aset',AsetController::class);
Route::resource('kamar_sewa',KamarSewaController::class);
Route::resource('pindah_kamar',PindahKamarController::class);
Route::resource('pembayaran',PembayaranController::class);
Route::resource('tagihan',TagihanController::class);
Route::resource('myregister',PenyewaRegister::class);
Route::resource('reservasi',ReservasiController::class);
Route::resource('pengeluaran',PengeluaranController::class);
Route::resource('laporan',LaporanController::class);
Route::resource('laporan_pengeluaran',LaporanPengeluaran::class);
Route::resource('laporan_pemasukan',LaporanPemasukan::class);
Route::resource('laporan_pembayaran',HistPembayaranController::class);
Route::resource('lanjut',LanjutNgekostController::class);
Route::get('daftar_bayar',[PembayaranController::class,'df_bayar'])->name('df.bayar');

Route::get('hash/{nilai}',function($nilai){
    return Hash::make($nilai);
});
Route::get('create_fasilitas/{kamar_id}',[FasilitasController::class,'kamar_selected'])->name('fasilitas.kamar.terpilih');
Route::get("user.aktifasi/{user}",[UserController::class,'aktifasi'])->name('user.aktivasi');
Route::get("pembayaran_penghuni/{penyewa_id}",[PembayaranController::class,'cek_va'])->name('penghuni.bayar');
Route::get("pembayaran_create/{kamar_sewa_id}",[PembayaranController::class,'create'])->name('penghuni.bayar.create');
Route::get("verifikasi.pembayaran/{pembayaran_id}",[PembayaranController::class,'verifikasi'])->name('pembayaran.verifikasi');
Route::get("cetak.pembayaran/{kamar_sewa_id}",[PembayaranController::class,'cetak'])->name('pembayaran.cetak');
Route::get("penyewa.checkout/{kamar_sewa_id}",[PenyewaController::class,'checkout'])->name('penyewa.checkout');

Route::resource('clntpembayaran',PenghuniPembayaranController::class);
Route::get('clnt_byr_penghuni/{penyewa_id}',[PenghuniPembayaranController::class,'cek_va'])->name('clntpembayaran.bayar');
Route::get('clnt_req_bayar/{kamar_sewa_id}',[PenghuniPembayaranController::class,'create_byr'])->name('clntpembayaran.createbayar');

Route::get('forbidden',[ErrController::class,'forbidden'])->name('forbidden_kingdom');