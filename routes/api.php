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
});

Route::group(['prefix'=>'select2'],function(){
    Route::get('aset/{id_kamar}',[SelectTwo::class,'getAset'])->name('api.select2.aset');
    Route::get('api.cek.kamar/{id_kamar?}',[SelectTwo::class,'getKamar'])->name('api.select2.kamar');
});
