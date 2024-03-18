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
            'name' => 'Rishav Paul',
            'email' => 'taskman.rishav@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
        ])->assignRole('super-admin');
    }
}
