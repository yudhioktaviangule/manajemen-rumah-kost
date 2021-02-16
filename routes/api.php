<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DataTable;
use App\Http\Controllers\Api\SelectTwo;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'dt'],function(){
    Route::get('kamar',[DataTable::class,'kamar_fasilitas'])->name('api.datatable.fasilitas');
    Route::get('kamar_sewa',[DataTable::class,'kamar_sewa'])->name('api.datatable.kamar');
    Route::get('dt/pemeliharaan',[DataTable::class,'pemeliharaan'])->name('api.datatable.pemeliharaan');
    Route::get('dt/perawatan',[DataTable::class,'perawatan'])->name('api.datatable.perawatan');
    Route::get('dt/t_aset',[DataTable::class,'tambahAset'])->name('api.datatable.tambah.aset');
});

Route::group(['prefix'=>'select2'],function(){
    Route::get('aset/{id_kamar}',[SelectTwo::class,'getAset'])->name('api.select2.aset');
    Route::get('all.aset',[SelectTwo::class,'getAset'])->name('api.select2.aset.all');
    Route::get('api.cek.kamar/{id_kamar?}',[SelectTwo::class,'getKamar'])->name('api.select2.kamar');
});
