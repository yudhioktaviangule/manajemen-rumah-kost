<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
class PerawatanController extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }
    public function index(){
        $request = $this->request; 
        return view('halaman.pengeluaran.perawatan.index');
    }
    public function create(){
        $request = $this->request; 
        $route_api = route('api.select2.kamar.in.fas');
        return view('halaman.pengeluaran.perawatan.create',compact('route_api'));
    }
    public function show($id=''){
        $request = $this->request; 
    }
    public function edit($id=''){
        $request = $this->request; 
    }
    public function store(){
        $request = $this->request; 
        $request = $this->request; 
        $request = $this->request; 
        $post    = $request->only('user_id','keterangan','total_biaya','fasilitas_id');
        $post['jenis_pengeluaran']  = 'perbaikan fasilitas';
        $post['aset_id']       = 0;
        $post['kamar_id']           = 0;
        $post['jenis_pemeliharaan'] = "-";
        $pengeluaran = new Pengeluaran();
        $pengeluaran->fill($post);
        $pengeluaran->save();
        return redirect(route('perawatan.index'));
    }
    public function update($id=''){
        $request = $this->request; 
    }
    public function destroy($id=''){
        #code
    }
}