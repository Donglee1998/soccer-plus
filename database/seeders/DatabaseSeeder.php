<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CreateAdminSeeder::class);
        // $this->call(AdminRegistrationSeeder::class);
        // $this->call(TeamSeeder::class);
        // $this->call(MemberSeeder::class);
        // $this->call(MatchSeeder::class);
        // $this->call(LineUpSeeder::class);
        // $this->call(ContactSeeder::class);
    }
}
