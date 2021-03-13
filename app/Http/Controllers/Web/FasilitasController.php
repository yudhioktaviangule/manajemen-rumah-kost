<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Aset;
use App\Models\Fasilitas;
class FasilitasController extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
        $this->middleware('auth');
    }
    public function index(){
        $request = $this->request; 
        return view('halaman.fasilitas.index');
    }
    public function create(){
        $request = $this->request; 
        $id = $request->id==NULL?NULL : $request->id;
        if($id==NULL){
            return redirect(route('fasilitas.index'));
        }
        $cek = Kamar::find($id);
        if($cek==NULL){
            return redirect(route('fasilitas.index'));
        }

        return view('halaman.fasilitas.create',compact('cek'));


    }
    public function show($id=''){
        $request = $this->request; 
    }
    public function edit($id=''){
        $request = $this->request; 
    }
    public function store(){
        $request = $this->request; 
        $post = $request->only('keterangan','kamar_id','aset_id');
        $post['kondisi'] = $request->status;
        $fasilitas = new Fasilitas();
       // dd($post);
        $fasilitas->fill($post);
        $fasilitas->save();
        return redirect(route('fasilitas.kamar.terpilih',['kamar_id'=>$post['kamar_id']]));

    }
    public function update($id=''){
        $request = $this->request; 
    }
    public function destroy($id=''){
        $fas = Fasilitas::find($id);
        if($fas!=NULL):
            Fasilitas::where('id',$id)->delete();
            return redirect()->back();
        else:
            return redirect()->back();
        endif;

    }
    public function kamar_selected($id)
    {
        $data = Kamar::find($id);
        if($data==NULL):
            return redirect(route('fasilitas.index'))->withErrors(['Kamar Tidak ditemukan']);
        endif;
        $fasilitas = Fasilitas::where('kamar_id',$data->id)->get();
        return view('halaman.fasilitas.kamar_selected',compact('data','fasilitas'));
    }
}