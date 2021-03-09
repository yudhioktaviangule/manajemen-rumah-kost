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


    public function getUser()
    {
        return User::find($this->user_id);
    }
}
