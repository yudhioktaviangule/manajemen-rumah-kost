<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPenyewaPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|min:3',
            'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'nama_contact'      => 'required',
            'hubungan_keluarga' => 'required',
            'telepon_contact'   => 'required',
            'jk'                => 'required',
            'kamar_id'          => 'required',
            'kota_asal'         => 'required',
            'lama_sewa'         => 'required|numeric|min:1',
            'pekerjaan'         => 'required',
            'hp'                => 'required|min:10|unique:penyewas',
            'nik'               => 'required|min:16|max:16|unique:penyewas',
        ];
    }
}
