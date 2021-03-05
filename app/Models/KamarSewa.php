<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KamarSewa extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
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
}
