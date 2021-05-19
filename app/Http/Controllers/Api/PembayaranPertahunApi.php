<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranPertahunApi extends Controller
{

    private function getData($kamar,$tahun){
        $totalRes = 0;
        foreach($kamar as $key =>$kamars):
            $pembayaran[$key] = [
                'kamar'=>$kamars,
                'detail' => [],
                'subtotal' => 0,
            ];
            $subtotal = 0;
            $p=[];
            for($i = 1;$i<13;$i++){
                $bulana = sprintf("%02d",$i);
                if($i+1==13){
                    $bulanb = sprintf("%02d",(1));
                    $tahunplus = $tahun+1;
                }else{
                    $bulanb = sprintf("%02d",($i+1));
                    $tahunplus= $tahun;
                }
                $a = "$tahun-$bulana-01";
                $b = "$tahunplus-$bulanb-01";
                $sum = Pembayaran::whereIn('kamar_sewa_id',function($kmr)use($kamars){
                    $kmr->select("id")->from("kamar_sewas")->where('kamar_id',$kamars->id);
                })
                ->where('virtual_account','selesai')->whereBetween('updated_at',[$a,$b])->sum('pembayaran');
                
                
                $sum2 = Pembayaran::whereIn('kamar_sewa_id',function($kmr)use($kamars){
                    $kmr->select("id")->from("checkout_kamar_sewas")->where('kamar_id',$kamars->id);
                })
                ->where('virtual_account','selesai')->whereBetween('updated_at',[$a,$b])->sum('pembayaran');
                
                
                $subtotal+=intval($sum+$sum2);
                
                $pembayaran[$key]['detail'][] = $sum;
            }
            $pembayaran[$key]['subtotal'] = $subtotal;
            $totalRes+=$subtotal;
        endforeach;
        return ['periode'=>intval($tahun),'total_res'=>$totalRes,'results'=>$pembayaran,'p'=>$p];
    }
    public function getPertahun($tahun,$kamar_id='0')
    {
        if($kamar_id=='0'){
            $kamar = Kamar::get();
        }else{
            $kamar = Kamar::find($kamar_id);
            $kamar = $kamar==NULL?Kamar::get():[$kamar];
        }

        $json = $this->getData($kamar,$tahun);
        return response()->json($json);
    }

    public function getKamar()
    {
        $json = Kamar::get();
        return response()->json($json);
    }
}
