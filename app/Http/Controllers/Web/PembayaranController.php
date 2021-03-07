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
    public function create($kamar=''){
        $request = $this->request; 
        $skid = $kamar;
        if($skid==NULL):
            return redirect(route('penyewa.index'));
        endif;
        $data = KamarSewa::find($skid);
        if($data==NULL):
            return redirect(route('penyewa.index'));
        endif;
        return view('halaman.pembayaran.create',compact('data'));
    }
    public function show($id=''){
        $request = $this->request; 
    }
    public function edit($id=''){
        $request = $this->request; 
    }
    public function createNomor($ksid)
    {
        $cnt = Pembayaran::where('kamar_sewa_id',$ksid)->count();
        $cnt++;
        $f = false;
        while(!$f){
            $nomor_fmt = date("YmdHis").sprintf("%04d",$cnt);
            $cek = Pembayaran::where('nomor',$nomor_fmt)->first();
            if($cek==NULL):
                $f=true;
            else:
                $cnt--;
            endif;
        }
        $nmr = [
            'nomor' => $nomor_fmt,
            'name'  => "Pembayaran Kost Ke-$cnt",
        ];

        return json_decode(json_encode($nmr));
        
    }
    public function store(){
        $request = $this->request; 
        $post = json_decode(json_encode($request->input()));
        $level = Auth::user()->level;
        $kamarsewa = KamarSewa::find($post->kamar_sewa_id);
        if($kamarsewa===NULL):
            return redirect(route('penyewa.index'));
        endif;
        $virtual_account = 'verifikasi';
        if($level==='admin'||$level==='karyawan'):
            $user_id = Auth::id();
            if($post->metode_pembayaran==='tunai'):
                $virtual_account = 'selesai';
            endif;
        else:
            $user_id = 0;
        endif;
        $n = $this->createNomor($post->kamar_sewa_id);
        $data = [
            'kamar_sewa_id'   => $post->kamar_sewa_id,
            'nomor'           => $n->nomor,
            'name'            => $n->name,
            'metode'          => $post->metode_pembayaran,
            'pembayaran'      => $post->jumlah_bayar,
            'user_id'         => $user_id,
            'virtual_account' => $virtual_account,
        ];
        
        $pbayaran = new Pembayaran();
        $pbayaran->fill($data);
        $pbayaran->save();
        
        $sum = Pembayaran::where('kamar_sewa_id',$post->kamar_sewa_id)->sum('pembayaran');
        if($sum<$kamarsewa->total_sewa):
            $tanggal = Carbon::now()->addMonths(1);
        else:
            $tanggal = Carbon::parse($kamarsewa->created_at)->addMonths($kamarsewa->lama_sewa);
        endif;
        $kamarsewa->jatuh_tempo = $tanggal;
        $kamarsewa->save();
        $penyewa_id = $kamarsewa->penyewa_id;
        return redirect(route('penghuni.bayar',['penyewa_id'=>$penyewa_id]));
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

    public function cek_va($penyewa_id='')
    {
        $ks = KamarSewa::where('penyewa_id',$penyewa_id)->first();
        if($ks==NULL):
            return redirect()->back();
        endif;
        return view('halaman.penyewa.pembayaran',compact('ks'));

    }
}
