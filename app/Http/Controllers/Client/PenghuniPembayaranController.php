<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use App\Models\Pembayaran;
use App\Models\KamarSewa;
class PenghuniPembayaranController extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
    }
    public function index(){
        $request = $this->request;
    }
    public function create(){
        $request = $this->request;
    }
    public function store(){
        $request = $this->request;
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
    public function cek_va($penyewa_id)
    {
        $ks = KamarSewa::where('penyewa_id',$penyewa_id)->first();
        if($ks==NULL):
            return redirect()->back();
        endif;
        return view('halaman_client.penyewa.va',compact('ks'));
    }
    public function create_byr($kamar=''){
        $request = $this->request; 
        $skid = $kamar;
        if($skid==NULL):
            return redirect(route('penyewa.index'));
        endif;
        $data = KamarSewa::find($skid);
        if($data==NULL):
            return redirect(route('penyewa.index'));
        endif;
        return view('halaman_client.penyewa.pembayaran',compact('data'));
    }
}