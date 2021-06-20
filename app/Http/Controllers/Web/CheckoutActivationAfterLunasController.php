<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CheckoutKamarSewa;
use App\Models\Kamar;
use App\Models\KamarSewa;
use App\Models\Penyewa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class CheckoutActivationAfterLunasController extends Controller{
    private $request;
    public function __construct(Request $request) {
        $this->request = $request;
        $this->middleware('auth');
    }
    public function showCheckoutUser($id)
    {
        $chek = CheckoutKamarSewa::find($id);
        $penyewa = $chek->getPenyewa();
        $kamar = $chek->getKamar();
        $kamar->status='ready';
        $kamar->save();
        return view("halaman.penyewa.lanjut_sewa.index",compact('chek','penyewa','kamar'));
    }
    public function index(){
        $request = $this->request;
        if($request->kamar!=NULL&&$request->penyewa!=NULL):
            $penyewa = Penyewa::find($request->penyewa);
            $kamar = Kamar::find($request->kamar);
            if($penyewa!=NULL&&$kamar!=NULL):
                return view("halaman.penyewa.lanjut_sewa.pilih_Lama",compact('penyewa','kamar'));
            endif;
        endif;
    }
    public function create(){
        $request = $this->request;
    }
    public function store(){
        $carb = \Carbon\Carbon::class;
        $request = $this->request;
        $post = $request->only("penyewa","kamar","lama_sewa");
        $kamar = Kamar::find($post['kamar']);
        $penyewa = Penyewa::find($post['penyewa']);
        $total = $kamar->harga*$post['lama_sewa'];
        if($kamar!=NULL&&$penyewa!=NULL):
            $sewaKamar = new KamarSewa();
            $ps['penyewa_id']  = $post['penyewa'];
            $ps['kamar_id']    = $post['kamar'];
            $ps['lama_sewa']   = $post['lama_sewa'];
            $ps['total_sewa']  = $total;
            $ps['jatuh_tempo'] = $carb::now()->addMonths($post['lama_sewa'])->format('Y-m-d');
            $sewaKamar->fill($ps);
            $sewaKamar->save();
            $kamar->is_locked = "yes";
            $kamar->save();
            $user = User::where("penyewa_id",$penyewa->id)->first();
            $user->aktif="aktif";
            $user->save();
            return redirect(route('penyewa.show',['penyewa'=>$post['penyewa']]));
        endif;
    }
    public function show($id){
        $request = $this->request;
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