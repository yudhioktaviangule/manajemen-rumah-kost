<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyewa;
use App\Models\KamarSewa;
use App\Models\Kamar;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class ReservasiController extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }
    public function index(){
        $request = $this->request;
    }
    public function create(){
        $request = $this->request;
        if($request->id==NULL):
            return redirect()->back();
        endif;
        $id = $request->id;
        $data = Penyewa::find($id);
        if($data==NULL):
            return redirect()->back();
        endif;  
        return view('halaman.reservasi.create',compact('data'));
    }
    public function store(){
        $request = $this->request;
        
        $post = $request->only("penyewa_id","kamar_id","jatuh_tempo",'lama_sewa','total_sewa');
        $sewa = new KamarSewa();
        $sewa->fill($post);
        $sewa->save();
        $kamar = Kamar::find($post['kamar_id']);
        $kamar->status='disewa';
        $kamar->save();
        return redirect(route('penyewa.index'));
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