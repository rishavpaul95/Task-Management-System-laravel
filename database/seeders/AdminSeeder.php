<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
            'name' => 'Admin',
            'email' => 'taskman.rishav@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'company_id' => 1,
        ])->assignRole('super-admin', 'admin');
    }
}
