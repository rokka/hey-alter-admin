<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Test Benutzer',
            'email' => 'test@heyalter.com',
            'password' => '$2y$10$cQXjmHIFw1.9sYrYlv.3DeU6EiFG95XqGzl7g735L8xQFvKq7YGaa', //testtest
            'current_team_id' => 1,
        ]);
    }
}
