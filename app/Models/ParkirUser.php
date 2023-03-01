<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkirUser extends Model
{
    protected $fillable = [
        'kode_unik',
        'no_kendaraan',
        'merk',
        'tipe',
        'waktu_masuk',
        'waktu_keluar',
        'tarif',
        'status',
    ];

    public function getData($kode_unik)
    {
        return DB::table('parkir_users')->where('kode_unik', $kode_unik)->first();
    }
}
