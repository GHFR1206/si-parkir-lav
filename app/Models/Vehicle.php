<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $primaryKey = 'vehicle_id';
    protected $fillable = [
        'id', 'no_kendaraan', 'tipe', 'merk'
    ];

    public function parking()
    {
        return $this->hasOne(Parking::class);
    }
}
