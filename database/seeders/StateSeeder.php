<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            ['stateName' => 'banned'],
            ['stateName' => 'dislike'],
            ['stateName' => 'unmatch']
        ];

        State::insert($states);
    }
}
