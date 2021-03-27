<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PemeliharaanController extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
        $this->middleware('auth');
        $this->middleware('auth.admin');
    }
    public function index(){
        $request = $this->request; 
        
        return view("halaman.pengeluaran.pemeliharaan.index");
    }
    public function create(){
        $request = $this->request;
        $route_api = route('api.select2.kamar',['id_kamar'=>'']); 
        return view('halaman.pengeluaran.pemeliharaan.create',compact('route_api'));
    }
    public function show($id=''){
        $request = $this->request; 
        $data = Pengeluaran::find($id);
        if($data==NULL):
            return redirect(route("pemeliharaan.index"));
        endif;
        return view('halaman.pengeluaran.show',compact('data'));
    }
    public function edit($id=''){
        $request = $this->request; 
    }
    public function store(){
        $request = $this->request; 
        $post = $request->only('user_id','jenis_pemeliharaan','keterangan','total_biaya','kamar_id');
        $post['jenis_pengeluaran'] = 'pemeliharaan';
        $post['fasilitas_id']      = 0;
        $post['aset_id']           = 0;

      //  dd($post);
        $pemeliharaan = new Pengeluaran();

        $pemeliharaan->fill($post);

        $pemeliharaan->save();
        return redirect(route('pemeliharaan.index'));

    }
    public function update($id=''){
        $request = $this->request; 
    }
    public function destroy($id=''){
        
    }
}
