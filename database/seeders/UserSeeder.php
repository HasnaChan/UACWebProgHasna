<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            User::create([
            'name' => 'Hasna Salsabilla',
            'email' => 'hasna@gmail.com',
            'password' => Hash::make('12345'),
            'phoneNumber' => '081515856062',
            'gender' => 'female',
            'linkedin' => 'https://www.linkedin.com/in/hasna-salsabilla-abdullah-189914249/',
            'job_id' => 1,
            'state_id' => 1,
            'admin' => 0,
            'wallet' => 100000,
            'photo' => 'photo/hasna.jpg',
        ]);

        User::create([
            'name' => 'Tammy Visca',
            'email' => 'tammy@gmail.com',
            'password' => Hash::make('12345'),
            'phoneNumber' => '081515856062',
            'gender' => 'female',
            'linkedin' => 'https://www.linkedin.com/in/hasna-salsabilla-abdullah-189914249/',
            'job_id' => 3,
            'state_id' => 1,
            'admin' => 0,
            'wallet' => 100000,
            'photo' => 'photo/hasna.jpg',
        ]);

        User::create([
            'name' => 'Jefferson',
            'email' => 'jeff@gmail.com',
            'password' => Hash::make('12345'),
            'phoneNumber' => '081515856062',
            'gender' => 'male',
            'linkedin' => 'https://www.linkedin.com/in/hasna-salsabilla-abdullah-189914249/',
            'job_id' => 2,
            'state_id' => 1,
            'admin' => 0,
            'wallet' => 100000,
            'photo' => 'photo/jaehyun.jpg',
        ]);

        User::create([
            'name' => 'Brychan Artanto',
            'email' => 'brychan@gmail.com',
            'password' => Hash::make('12345'),
            'phoneNumber' => '081515856062',
            'gender' => 'male',
            'linkedin' => 'https://www.linkedin.com/in/hasna-salsabilla-abdullah-189914249/',
            'job_id' => 3,
            'state_id' => 1,
            'admin' => 0,
            'wallet' => 100000,
            'photo' => 'photo/jaehyun.jpg',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            'phoneNumber' => '081515856062',
            'gender' => 'male',
            'linkedin' => 'https://www.linkedin.com/in/hasna-salsabilla-abdullah-189914249/',
            'job_id' => 3,
            'state_id' => 1,
            'admin' => 1,
            'wallet' => 100000,
            'photo' => 'photo/hasna.jpg',
        ]);
    }
}
