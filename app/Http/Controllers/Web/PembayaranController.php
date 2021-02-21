<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KamarSewa;
use App\Models\Pembayaran;
use Carbon\Carbon;
class PembayaranController extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
        $this->middleware('auth');
    }
    public function index(){
        $request = $this->request; 
        return view("halaman.pembayaran.index");
    }
    public function create(){
        $request = $this->request; 
        $skid = $request->sk_id;
        if($skid==NULL):
            return redirect(route('pembayaran.index'));
        endif;
        $data = KamarSewa::find($skid);
        if($data==NULL):
            return redirect(route('pembayaran.index'));
        endif;
        return view('halaman.pembayaran.create',compact('data'));
    }
    public function show($id=''){
        $request = $this->request; 
    }
    public function edit($id=''){
        $request = $this->request; 
    }
    public function store(){
        $request = $this->request; 
        $post = json_decode(json_encode($request->input()));
        $json = [
            'tagihan' => $post->total_pembayaran,
            'jumlah_bayar' => $post->jumlah_bayar,
        ];
        $jencode = $request->only('kamar_sewa_id');
        $jencode['user_id'] = Auth::id();
        $jencode['json'] = json_encode($json);
        $pbayaran = new Pembayaran();
        $pbayaran->fill($jencode);
        $pbayaran->save();
        $now     = Carbon::now();
        $kmr     = KamarSewa::find($jencode['kamar_sewa_id']);
        $harga   = intval($post->jumlah_bayar/$kmr->getKamar()->harga); 
        dd($harga);
        $tanggal = Carbon::parse($kmr->jatuh_tempo)->addMonths($harga);
        $kmr->jatuh_tempo = $tanggal;
        $kmr->save();
        return redirect(route('pembayaran.index'));
    }
    public function update($id=''){
        $request = $this->request; 
    }
    public function destroy($id=''){
        
    }
    public function pilihPenyewa()
    {
        return view('halaman.pembayaran.penyewa');
    }

    public function df_bayar()
    {
        return view('halaman.pembayaran.list');
    }
}
