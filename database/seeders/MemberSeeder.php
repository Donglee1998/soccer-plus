<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;

class MemberSeeder extends Seeder
{
    use WithFaker;

    public function __construct()
    {
        $this->setUpFaker();
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // formation 4-4-2
        $position = [1,2,2,2,2,3,3,3,3,4,4,1,2,2,2,2,3,3,3,3,4,4];
        for ($i = 1; $i <= 22; $i++) {
            DB::table('members')->insert([
                [
                    'team_id'         => 1,
                    'first_name'      => $this->faker->firstName(),
                    'last_name'       => $this->faker->lastName(),
                    'birthday'        => $this->faker->dateTimeBetween('-25 years', '-21 years')->format('Y-m-d'),
                    'number_official' => $i,
                    'number_practice' => $i,
                    'position'        => $position[$i-1],
                    'dominant_foot'   => $this->faker->numberBetween(1, 2),
                    'height'          => $this->faker->numberBetween(50, 100),
                    'weight'          => $this->faker->randomFloat(2, 0, 100),
                    'school'          => $this->faker->word,
                    'email'           => $this->faker->email,
                    'former_team'     => '',
                    'created_by'      => 1,
                ]
            ]);
        };

        for ($i = 1; $i <= 22; $i++) {
            DB::table('members')->insert([
                [
                    'team_id'         => 2,
                    'first_name'      => $this->faker->firstName,
                    'last_name'       => $this->faker->lastName,
                    'birthday'        => $this->faker->dateTimeBetween('-25 years', '-21 years')->format('Y-m-d'),
                    'number_official' => $i,
                    'number_practice' => $i,
                    'position'        => $position[$i-1],
                    'dominant_foot'   => $this->faker->numberBetween(1, 2),
                    'height'          => $this->faker->numberBetween(50, 100),
                    'weight'          => $this->faker->randomFloat(2, 0, 100),
                    'school'          => $this->faker->word,
                    'email'           => $this->faker->email,
                    'former_team'     => '',
                    'created_by'      => 1,
                ]
            ]);
        };
    }
}
