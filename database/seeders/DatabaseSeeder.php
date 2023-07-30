<?php

namespace Database\Seeders;

use Database\Seeders\EmployeeSeeder;
use Database\Seeders\SupervisorSeeder;
use Database\Seeders\TeamSeeder;
use Database\Seeders\EmployeeActivitySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SupervisorSeeder::class,
            EmployeeSeeder::class,
            TeamSeeder::class,
            EmployeeActivitySeeder::class,
        ]);
    }
}