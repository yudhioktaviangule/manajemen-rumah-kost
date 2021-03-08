<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'nomor',
        'nominal',
        'pengeluaran',
        'status',
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
