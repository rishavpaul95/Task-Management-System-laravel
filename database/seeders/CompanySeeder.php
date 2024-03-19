<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = new Company();
        $company->name = "Taskman";
        $company->email = "taskman.rishav@gmail.com";
        $company->address = "Kolkata";
        $company->website = "https://taskman.com";
        $company->save();
    }
}
