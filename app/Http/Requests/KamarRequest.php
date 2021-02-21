<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KamarRequest extends FormRequest
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
            'nomor' => 'required|unique:kamars|max:4',
            'harga' => 'required',
        ];
    }

    public function messages()
    {
        return[
            'nomor.required' => 'Nomor Kamar tidak boleh kosong',
            'nomor.unique'   => 'Nomor Kamar sudah terdaftar',
            'nomor.max'      => 'Nomor Kamar max 4 digit',
            'harga.required' => 'Harga Sewa tidak boleh kosong',
        ];
    }
}
