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
        'kota_asal',
        'pekerjaan',
        'nik',
        'jenis_kelamin',
        'nama_contact',
        'hubungan_keluarga',
        'telepon_contact',
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
    public function getUser()
    {
       return User::where('penyewa_id',$this->id)->first();
    }
}
