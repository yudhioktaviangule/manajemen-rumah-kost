<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class LaporanPemasukan extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }
    public function index(){
        $request = $this->request;
        return view('halaman.lap_pemasukan.index');
    }
    public function create(){
        $request = $this->request;
    }
    public function store(){
        $request = $this->request;
        $data = $request->only('tanggal_awal','tanggal_akhir','transaksi');
        $between = [$data['tanggal_awal'],$data['tanggal_akhir']];
        $jenis  = $data['transaksi'];
        return view('cetak.lap_pemasukan',compact('between','jenis')); 
    }
    public function show($id){
        $request = $this->request;
    }
    public function edit($id){
        $request = $this->request;
    }
    public function update($id){
        $request = $this->request;
    }
    public function destroy($id){
        $request = $this->request;
    }
}