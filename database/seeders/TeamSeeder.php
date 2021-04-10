<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'user_id' => 1,
            'name' => 'HA-T',
            'personal_team' => false,
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'HA-BS',
            'personal_team' => false,
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'HA-EVR',
            'personal_team' => false,
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'HA-A',
            'personal_team' => false,
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'HA-S',
            'personal_team' => false,
        ]);
    }
}
