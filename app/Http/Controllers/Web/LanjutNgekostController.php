<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\KamarSewa;
class LanjutNgekostController extends Controller{
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
    }
    public function store(){
        $request = $this->request;
        $post = $request->only('lama_sewa');
        $id = $request->kamar_sewa_id;
        $ks = KamarSewa::find($id);
        $kamar = $ks->getKamar();
        $total = $kamar->harga * $post['lama_sewa'];
        if($ks==NULL):
            return redirect()->back();
        endif;
        $ks->lama_sewa = $request->lama_sewa;
        $ks->total_sewa = $total;
        $ks->save();
        return redirect(route('penyewa.show',['penyewa'=>$ks->penyewa_id]));
    }
    public function show($id){
        $request = $this->request;
        $ks = KamarSewa::find($id);
        return view('halaman.lanjut_sewa.lanjut',compact('ks'));
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