<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CheckoutKamarSewa;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KamarSewa;
use App\Models\Pembayaran;
use App\Models\Penyewa;
use Carbon\Carbon;
class PembayaranController extends Controller{
    private $request;
    public function __construct(Request $request){
        $this->request = $request; 
        $this->middleware('auth');
        $this->middleware('auth.admin',['except'=>['store']]);
        
    }
    public function index(){
        $request = $this->request; 
        return view("halaman.pembayaran.index");
    }
    public function create($kamar=''){
        $this->middleware('auth.admin');
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
        $byr = Pembayaran::where("kamar_sewa_id",$post->kamar_sewa_id)->sum('pembayaran');
        $penyewa_id = $kamarsewa->penyewa_id;  
        $rto = $byr+$post->jumlah_bayar <= $kamarsewa->total_sewa;
        //dd($rto);
        $checkout=false;
        if($rto){
            $pbayaran = new Pembayaran();
            $pbayaran->fill($data);
            $pbayaran->save();
            $sum = Pembayaran::where('kamar_sewa_id',$post->kamar_sewa_id)->sum('pembayaran');
            $tanggal = Carbon::now()->addMonths(1);
            if($sum<$kamarsewa->total_sewa):
            elseif($sum==$kamarsewa->total_sewa):
                $checkout=true;
            else:
                $tanggal = Carbon::parse($kamarsewa->created_at)->addMonths($kamarsewa->lama_sewa);
            endif;
            $kamarsewa->jatuh_tempo = $tanggal;
            $kamarsewa->save();
                      
        }
        if($checkout){
            $v = "tambah.lama.sewa";
            $checkout_id = $this->checkoutIfComplete($post->kamar_sewa_id);
            return redirect(route($v,['checkout_id'=>$checkout_id]));
        }else{
            $v = Auth::user()->level==='penyewa' ? 'clntpembayaran.bayar' : 'penghuni.bayar';
            return redirect(route($v,['penyewa_id'=>$penyewa_id]));
        }


      /*   if($checkout){
            return redirect(route('penyewa.checkout',['kamar_sewa_id'=>$kamarsewa->id]));
        } */

    }
    public function update($id=''){
        $request = $this->request; 
    }

    public function checkoutIfComplete($id)
    {
        $data = KamarSewa::find($id);
        $checkout = new CheckoutKamarSewa();
        $p='';
        
        $p = $data->penyewa_id;
        $kamar  = $data->kamar_id;
        $dkamar = Kamar::find($kamar);
        if($dkamar==NULL):
            return redirect()->back();
        endif;
        $dkamar->status='ready';
        $dkamar->save();
        $dsewa = Penyewa::find($p);
        $sewa = $dsewa->getUser();  
        $sewa->aktif='checkout';
        $sewa->save();
        $chk = [
            'tmp_id' => $data->id,
            'penyewa_id' => $data->penyewa_id,
            'kamar_id' => $data->kamar_id,
            'jatuh_tempo' => $data->jatuh_tempo,
            'lama_sewa' => $data->lama_sewa,
            'total_sewa' => $data->total_sewa,
        ];
        $checkout->fill($chk);
        $checkout->save();
        $data->delete();
        
        return $checkout->id;
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

    public function verifikasi($id='')
    {
        $level = Auth::user()->level;
        if($level==='admin'||$level==='karyawan'):
            $p = Pembayaran::find($id);
            $p->virtual_account = 'selesai';
            $p->user_id = Auth::id();
            $p->save();
        endif;
        return redirect()->back();
    }
    public function cetak($id='')
    {
        $level = Auth::user()->level;
        if($level==='admin'||$level==='karyawan'):
            $ksewa = KamarSewa::find($id);
            if($ksewa===NULL):
                return redirect()->back();
            endif;
            return view('cetak.histori',compact('ksewa'));
        endif;
        return redirect()->back();
    }
}
