<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataTable;
use App\Http\Controllers\Api\LapKeluarApi;
use App\Http\Controllers\Api\SelectTwo;
use App\Http\Controllers\Api\MorrisApi;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'dt'],function(){
    Route::get('kamar',[DataTable::class,'kamar_fasilitas'])->name('api.datatable.fasilitas');
    Route::get('kamar_sewa',[DataTable::class,'kamar_sewa'])->name('api.datatable.kamar');
    Route::get('penyewakmr',[DataTable::class,'penyewaKamar'])->name('api.datatable.penyewa.kamar');
    
    Route::get('dt/l_bayar',[DataTable::class,'list_bayar'])->name('api.datatable.listbayar');
    Route::post('dt/penyewa',[DataTable::class,'penyewa'])->name('api.datatable.penyewa');
    Route::post('dt/pengeluaran',[DataTable::class,'pengeluaran'])->name('api.datatable.pengeluaran');
});
Route::group(['prefix'=>'select2'],function(){
    Route::get('aset/{id_kamar}',[SelectTwo::class,'getAset'])->name('api.select2.aset');
    Route::get('all.aset',[SelectTwo::class,'getAset'])->name('api.select2.aset.all');
    Route::get('api.cek.kamar/{id_kamar?}',[SelectTwo::class,'getKamar'])->name('api.select2.kamar');
    Route::get('api.cek.kamar.in.fas',[SelectTwo::class,'getKamarFas'])->name('api.select2.kamar.in.fas');
    Route::get('api.cek.fas/{id_kamar}',[SelectTwo::class,'getFasilitas'])->name('api.select2.fas');
});
Route::group(['prefix'=>'morris'],function(){
    Route::get('masuk.keluar',[MorrisApi::class,'masuk_keluar'])->name('chart_pemasukan');
    Route::get('masuk.keluar_skripi',[MorrisApi::class,'skripi'])->name('chart_pengeluaran');
});

Route::group(['prefix'=>'lap'],function(){
    Route::resource('api_lap_keluar',LapKeluarApi::class);
});