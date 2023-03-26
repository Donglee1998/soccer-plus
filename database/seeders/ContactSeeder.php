<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert(
            [
                [
                    'name'          => 'tobin+1',
                    'email'         => 'tobin@cybridge.jp+1',
                    'team'          => 'tobin1',
                    'status'        => 2,
                    'app_type'      => 1,
                    'content'       => 'tobin test +1',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],

                [
                    'name'          => 'tobin+2',
                    'email'         => 'tobin@cybridge.jp+2',
                    'team'          => 'tobin1',
                    'status'        => 2,
                    'app_type'      => 1,
                    'content'       => 'tobin test +2',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],

                [
                    'name'          => 'tobin+3',
                    'email'         => 'tobin@cybridge.jp+3',
                    'team'          => 'tobin1',
                    'status'        => 2,
                    'app_type'      => 1,
                    'content'       => 'tobin test +3',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],

                [
                    'name'          => 'tobin+4',
                    'email'         => 'tobin@cybridge.jp+4',
                    'team'          => 'tobin1',
                    'status'        => 2,
                    'app_type'      => 1,
                    'content'       => 'tobin test +4',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],

                [
                    'name'          => 'tobin+5',
                    'email'         => 'tobin@cybridge.jp+5',
                    'team'          => 'tobin1',
                    'status'        => 2,
                    'app_type'      => 1,
                    'content'       => 'tobin test +5',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ],
            ]
        );
    }
}
