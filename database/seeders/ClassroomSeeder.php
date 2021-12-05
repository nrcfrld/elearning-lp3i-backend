<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classroom::insert([
            [
                'name' => 'Informatika Komputer 12',
                'code' => 'IK-12',
                'major_id' => 1
            ],
            [
                'name' => 'Informatika Komputer 13',
                'code' => 'IK-13',
                'major_id' => 1
            ]
        ]);
    }
}
