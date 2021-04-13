<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class ValidasiPembayaranApi extends Controller
{
    public function validasiPembayaranTransfer($kamar_sewa_id=0)
    {
        $pbyr = Pembayaran::where('kamar_sewa_id',$kamar_sewa_id)->get();
        $isValidasi = true;
        foreach ($pbyr as $key => $value) {
            if(strtolower($value->virtual_account)==='verifikasi'):
                $isValidasi=false;
            endif;
        }
        return response()->json(['bisa_transfer'=>$isValidasi]);
    }    
}
