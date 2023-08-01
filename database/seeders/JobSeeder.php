<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            ['jobName' => 'Doctor'],
            ['jobName' => 'Programmer'],
            ['jobName' => 'Designer'],
            ['jobName' => 'Singer'],
            ['jobName' => 'Accountant']

        ];

        Job::insert($jobs);
    }
}
