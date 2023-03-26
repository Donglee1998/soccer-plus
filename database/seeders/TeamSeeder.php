<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'name'         => 'Sai Gon',
                'abbreviation' => 'SG',
                'gender'       => 1,
                'hometown'     => 'TP HCM',
                'coach'        => 'Phung Thanh Phuong',
                'trainer'      => 'Nguyen Van C',
                'color_home'   => 1,
                'color_guest'  => 5,
                'explanation'  => '',
                'order'        => 1,
                'created_by'   => 1,
            ],
            [
                'name'         => 'Ha Noi',
                'abbreviation' => 'HN',
                'gender'       => 1,
                'hometown'     => 'Ha Noi',
                'coach'        => 'Chun Jae-ho',
                'trainer'      => 'Hoang Van C',
                'color_home'   => 2,
                'color_guest'  => 4,
                'explanation'  => '',
                'order'        => 2,
                'created_by'   => 1,
            ],
        ]);
    }
}
