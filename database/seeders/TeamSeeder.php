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
            'name' => 'HA-Taubertal',
            'abbreviation' => 'HA-T',
            'personal_team' => false,
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'HA-Braunschweig',
            'abbreviation' => 'HA-BS',
            'personal_team' => false,
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'HA-Aachen',
            'abbreviation' => 'HA-A',
            'personal_team' => false,
        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'HA-Suttgart',
            'abbreviation' => 'HA-S',
            'personal_team' => false,
        ]);
    }
}
