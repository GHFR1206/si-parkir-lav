<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parking extends Model
{
    protected $fillable = [
        'kode_parkir',
        'vehicle_id',
        'waktu_masuk',
        'waktu_keluar',
        'tarif',
        'user_id',
        'status',
    ];

    public function getData($kode_parkir)
    {
        return DB::table('parkings')->where('kode_parkir', $kode_parkir)->first();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicleSearch($search)
    {
        return $this->vehicle()->where('no_kendaraan', 'LIKE', '%' . $search . '%');
    }
}
