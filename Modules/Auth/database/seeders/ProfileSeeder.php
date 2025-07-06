<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profiles')->insert([
            [
                'name' => 'Cargoaim',
                'email' => 'cargoaim@gmail.com',
                'contact' => '01979445544',
                'logo' => 'bscImg11745038891.jpg',
                'fav_icon' => 'bscImg11745182281.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
