<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KamarSewa;
use App\Models\Kamar;
class PindahKamarController extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
        $this->middleware('auth');
    }
    public function index(){
        $request = $this->request; 
    }
    public function create(){
        $request = $this->request; 
        $id = $request->id;
        if($id==NULL):
            return redirect()->back();    
        endif;
        
        $cek = KamarSewa::find($id);
        if($cek==NULL):
            return redirect()->back();
        endif;
        $penyewa = $cek->getPenyewa();
        return view('halaman.kamar_sewa.pindah',compact('cek','penyewa'));

    }
    public function show($id=''){
        $request = $this->request; 
    }
    public function edit($id=''){
        $request = $this->request; 
    }
    public function store(){
        $request = $this->request; 
    }
    public function update($id=''){
        $request = $this->request; 
        $post = $request->only('kamar_id');
        $cek = KamarSewa::find($id);
        $kid = $cek->kamar_id;
        if($cek==NULL):
            return redirect(route('penyewa.index'));
        endif;
        $cek = Kamar::find($post['kamar_id']);
        if($cek==NULL):
            return redirect(route('penyewa.index'));
        endif;
        $kamar=Kamar::find($kid);
        $cek = KamarSewa::find($id);
        $cek->kamar_id=$post['kamar_id'];
        $cek->save();
        $kamar->status='ready';
        $kamar->save();
        $kamar=Kamar::find($post['kamar_id']);
        $kamar->status='disewa';
        $kamar->save();
        return redirect(route('penyewa.index'));

    }
    public function destroy($id=''){
        #code
    }
}
