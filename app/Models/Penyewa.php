<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'hp',
        'jenis_kelamin',
    ];

    public function getKamar()
    {
        $kmr_sewa = KamarSewa::where('penyewa_id',$this->id)->orderBy('id','desc')->first();
        if($kmr_sewa==NULL):
            return NULL;
        else:
            return Kamar::find($kmr_sewa->kamar_id);
        endif;
    }

    public function getSewa()
    {
        return KamarSewa::where('penyewa_id',$this->id)->first();
    }
}
