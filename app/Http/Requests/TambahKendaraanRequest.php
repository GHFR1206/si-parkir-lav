<?php

namespace App\Http\Requests;

use App\Rules\ValidasiKodeUnik;
use Illuminate\Foundation\Http\FormRequest;

class TambahKendaraanRequest extends FormRequest
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
            'no_kendaraan' => [
                'required',
            ],
        ];
    }
}
