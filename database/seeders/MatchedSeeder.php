<?php

namespace Database\Seeders;

use App\Models\Matched;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatchedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Matched::create([
            'state_id' => 1,
            'manid'
        ]);
    }
}
