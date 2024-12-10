<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => "Admin",
            'username' => "Perencanaan",
            'password' => Hash::make("inspeksi2020"),
            'level' => "admin"
        ]);

        User::create([
            'name' => "Admin2",
            'username' => "TL",
            'password' => Hash::make("inspeksi2020"),
            'level' => "admin2"
        ]);
    }
}
