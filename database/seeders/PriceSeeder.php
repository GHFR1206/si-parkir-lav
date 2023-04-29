<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::create([
            'id' => 1,
            'tipe' => 'Motor',
            'tarif' => 2000
        ]);

        Price::create([
            'id' => 2,
            'tipe' => 'Mobil',
            'tarif' => 3000
        ]);

        Price::create([
            'id' => 3,
            'tipe' => 'Truk/Lainnya',
            'tarif' => 4000
        ]);
    }
}
