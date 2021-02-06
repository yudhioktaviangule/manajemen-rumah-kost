<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    use HasFactory;
    protected $fillable = [
        'fasilitas_id',
        'aset_id',   
        'user_id',
        'biaya',
    ]; 
}
