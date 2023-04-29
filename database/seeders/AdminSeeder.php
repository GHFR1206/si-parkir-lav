<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'username' => 'ghifari',
                'name' => 'Ghifari Hamdanigiar',
                'email' => 'aghifari1206@gmail.com',
                'password' => Hash::make('GHFR1206'),
                'role_id' => 1
            ],
        );

        User::create(
            [
                'username' => 'petugas1',
                'name' => 'Petugas Satu',
                'email' => 'petugas1@gmail.com',
                'password' => Hash::make('petugas1'),
                'role_id' => 2
            ],
        );
    }
}
