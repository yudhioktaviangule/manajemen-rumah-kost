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
    ];
    public function getPenyewa()
    {
        return Penyewa::find($this->penyewa_id);
    }
}
