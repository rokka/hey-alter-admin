<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComputerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('computers')->insert([
            'identifier' => 'HA-E-0001',
            'donor' => 'Max Mustermann',
            'email' => 'nettermensch@web.de',
            'model' => 'iMac',
            'state' => 'new',
            'comment' => 'Top in Schuss'
        ]);

        DB::table('computers')->insert([
            'identifier' => 'HA-E-0002',
            'model' => 'Lenovo XC 730',
            'state' => 'refurbished',
            'comment' => ''
        ]);

        DB::table('computers')->insert([
            'identifier' => 'HA-E-0003',
            'donor' => 'Eva Neumann',
            'email' => 'nettermensch@web.de',
            'model' => 'IBM Thinkpad',
            'state' => 'delivered',
            'comment' => ''
        ]);
    }
}
