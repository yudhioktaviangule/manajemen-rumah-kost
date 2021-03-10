<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutKamarSewa extends Model
{
    use HasFactory;
    protected $fillable = [
        'tmp_id',
        'kamar_id',
        'penyewa_id',
        'jatuh_tempo',
        'lama_sewa',
        'total_sewa',
    ];
    public function getPenyewa()
    {
        return Penyewa::find($this->penyewa_id);
    }
    public function getKamar()
    {
        return Kamar::find($this->kamar_id);
    }

    public function getPembayaran()
    {
        return Pembayaran::where('kamar_sewa_id',$this->id)->get();
    }

    public function getTotalBayar()
    {
        return Pembayaran::where('kamar_sewa_id',$this->id)->sum('pembayaran');
    }
    public function sisaPembayaran()
    {
        $total = Pembayaran::where('kamar_sewa_id',$this->id)->sum('pembayaran');
        $pembayaran = $this->total_sewa;
        $sisa = $pembayaran-$total;
        $json = [
            'saldo' => $sisa,
            'lunas' => $sisa==0,

        ];
        return json_decode(json_encode($json));
    }
}
