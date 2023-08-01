<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $states = [
            ['stateName' => 'default'],
            ['stateName' => 'waiting'],
            ['stateName' => 'match'],
            ['stateName' => 'dislike'],
            ['stateName' => 'unmatch']
        ];
    }
}
