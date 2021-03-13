<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'kamar_id',
        'aset_id',
        'keterangan',
        'kondisi'
    ];

    public function getKamar()
    {
        return Kamar::find($this->kamar_id);
    }

    public function getAset()
    {
        return Aset::find($this->aset_id);
    }
}
