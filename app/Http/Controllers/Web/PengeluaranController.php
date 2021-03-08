<?php

namespace App\Http\Controllers\Web;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
class PengeluaranController extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
    }
    public function index(){
        $request = $this->request;
        return view('halaman.pengeluaran.index');
    }
    public function create(){
        $request = $this->request;
        return view('halaman.pengeluaran.create');
    }
    private function generateNomor()
    {
        $inc = Pengeluaran::count();
        $inc++;
        $find = true;
        while($find){
            $number = 'PL'.date('dmY').'-'.sprintf('%04d',$inc);
            $c = Pengeluaran::where('nomor',$number)->first();
            if($c === NULL):
                $find=false;
            else:
                $inc--;
            endif;
        }
        return $number;
    }    
    public function store(){
        $request = $this->request;
        $nomor  = $this->generateNomor();
        $post = $request->input();
        unset($post['_token']);
        $post['nomor'] = $nomor;
        $post['user_id'] = Auth::id();
        $pengeluaran = new Pengeluaran();
        $pengeluaran->fill($post);
        $pengeluaran->save();
        return redirect(route('pengeluaran.index'));
    }
    public function show($id){
        $request = $this->request;
        $data = Pengeluaran::find($id);
        if($data==NULL):
            return redirect()->back();
        endif;
        return view('halaman.pengeluaran.show',compact('data'));
    }
    public function edit($id){
        $request = $this->request;
    }
    public function update($id){
        $request = $this->request;
    }
    public function destroy($id){
        $request = $this->request;
        $data = Pengeluaran::find($id);
        if($data!==NULL):
            $data->delete();
        endif;
        return redirect()->back();
    }
}
