<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name'              => 'Admin soccer plus',
                'email'             => 'soccerplus@gmail.com',
                'username'          => 'soccer-plus',
                'password'          => Hash::make('aZA*m5Wh'),
                'remember_token'    => Str::random(10),
                'email_verified_at' => now(),
            ],
        ]);
    }
}
