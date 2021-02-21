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
        'json',
        
    ];

    public function getKamarSewa()
    {
        return KamarSewa::find($this->kamar_sewa_id);
    }
}
