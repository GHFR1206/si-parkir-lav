<?php

namespace App\Rules;

use App\Models\Parking;
use Illuminate\Contracts\Validation\Rule;

class ValidasiKodeUnik implements Rule
{
    protected $kode_unik;
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Parking::where('kode_parkir', $value)->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kode salah';
    }
}
