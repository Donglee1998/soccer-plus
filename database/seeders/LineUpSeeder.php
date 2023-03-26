<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LineUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data1 = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        for ($i = 1; $i <= 4; $i++) {
            for ($j = 1; $j <= 11; $j++) {
                $order = $j+(($i-1)*11);
                ${'data' . $i}[] = [
                    'order'           => $j,
                    'member_id'       => $order,
                    'number_practice' => $order,
                    'number_official' => $order,
                ];
            }
        }

        DB::table('lineups')->insert([
            [
                'team_id'    => 1,
                'title'      => 'Lineup Team 1',
                'starting'   => json_encode($data1),
                'substitute' => json_encode($data2),
                'not_member' => NULL,
                'created_by'  => 1,
            ],
            [
                'team_id'    => 2,
                'title'      => 'Lineup Team 2',
                'starting'   => json_encode($data3),
                'substitute' => json_encode($data4),
                'not_member' => NULL,
                'created_by' => 1,
            ]
        ]);

    }
}
