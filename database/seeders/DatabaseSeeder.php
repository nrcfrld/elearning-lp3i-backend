<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CampusSeeder::class,
            StudyProgramSeeder::class,
            MajorSeeder::class,
            ClassroomSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            ConfigurationSeeder::class,
        ]);
    }
}
