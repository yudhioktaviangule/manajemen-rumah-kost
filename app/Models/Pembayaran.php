<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'kamar_sewa_id',
        'user_id',
        'nomor',
        'name',
        'metode',
        'virtual_account',
        'user_id',
        'pembayaran',
        
    ];

    public function getKamarSewa()
    {
        $ks = KamarSewa::find($this->kamar_sewa_id);
        if($ks===NULL):
            $ks = CheckoutKamarSewa::where('tmp_id',$this->kamar_sewa_id)->first();
        endif;
        return $ks;
    }
}
