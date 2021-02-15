<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyewa;
use App\Models\KamarSewa;
use App\Models\Kamar;
class KamarSewaController extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
        $this->middleware('auth');
    }
    public function index(){
        $request = $this->request; 

        return view("halaman.kamar_sewa.index");
    }
    public function create(){
        $request = $this->request; 
        $penyewa = $request->penyewa;
        if($penyewa==NULL):
            return redirect()->back();
        else:
            $penyewa = Penyewa::find($penyewa);
            return view('halaman.kamar_sewa.penyewa_selected',compact('penyewa'));
        endif;

    }
    public function show($id=''){
        $request = $this->request; 
        $cek = KamarSewa::find($id);
        $id_penyewa= $cek->penyewa_id;
        $idkamar= $cek->kamar_id;
        if($cek!==NULL):
            KamarSewa::where('id',$id)->delete();
            Penyewa::where('id',$id_penyewa)->delete();
            $d = Kamar::find($idkamar);
            $d->status='ready';
            $d->save();
        endif;
        return redirect(route('kamar_sewa.index'));
    }
    public function edit($id=''){
        $request = $this->request; 
    }
    public function store(){
        $request = $this->request; 
        $post = $request->only("penyewa_id","kamar_id","jatuh_tempo");
        $sewa = new KamarSewa();
        $sewa->fill($post);
        $sewa->save();
        $kamar = Kamar::find($post['kamar_id']);
        $kamar->status='disewa';
        $kamar->save();
        return redirect(route('kamar_sewa.index'));
    }
    public function update($id=''){
        $request = $this->request; 
    }
    public function destroy($id=''){
        $kost = KamarSewa::find($id);
        
    }
}
