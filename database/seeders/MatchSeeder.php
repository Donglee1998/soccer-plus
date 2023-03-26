<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matches')->insert([
            'id'                 => 11,
            'team_id1'           => 1,
            'team_color1'        => 1,
            'team_id2'           => 2,
            'team_color2'        => 2,
            'conference_name'    => 'Le Van A',
            'type'               => 1,
            'start_date'         => '2022-06-08',
            'start_time'         => '10:00',
            'place'              => 'My Dinh National Stadium',
            'referee'            => 'Le Van B',
            'linesman'           => 'Le Van C',
            'fourth_referee'     => 'Le Van D',
            'add_referee'        => 'Le Van E',
            'substitute_referee' => 'Le Van F',
            'var_referee'        => 'Le Van G',
            'weather'            => 1,
            'pitch_type'         => 1,
            'situation'          => 1,
            'number_people'      => 11,
            'round1_time'        => 90,
            'round2_time'        => 90,
            'round3_time'        => 0,
            'round4_time'        => 0,
            'additional_time1'   => 0,
            'additional_time2'   => 0,
            'additional_time3'   => 0,
            'additional_time4'   => 0,
            'rest_time'          => 15,
            'extra_time'         => 0,
            'penalty'            => 0,
            'comment'            => '',
            'status'             => 1,
            'created_by'         => 1,
        ]);
    }
}
