<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create([
            'name' => 'Punam Jha',
            'email' => 'rishavpaul1995@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$d2KvbngiunZlcSQb7aWUQuQ/xCfjIws28Gx9WadTwSwELaUz98ErK', // password
        ])->assignRole('manager');
    }
}
