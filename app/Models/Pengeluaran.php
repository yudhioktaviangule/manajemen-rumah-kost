<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'total_biaya',
        'jenis_pengeluaran',
        'fasilitas_id',
        'kamar_id',
        'aset_id',
        'jenis_pemeliharaan',
        'keterangan',
    ];



    public function getKamar()
    {
        return Kamar::find($this->kamar_id);
    }
    public function getAset()
    {
        return Aset::find($this->aset_id);
    }
    public function getFasilitas()
    {
        return Fasilitas::find($this->fasilitas_id);
    }
    public function getUser()
    {
        return User::find($this->user_id);
    }
}
