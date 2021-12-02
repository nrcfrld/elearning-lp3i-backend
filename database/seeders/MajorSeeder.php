<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Major::factory(10)->create()->each(function ($user) {

        });

        $user = \App\Models\Major::create([
            'name' => 'Informatika Komputer',
            'code' => 'IK',
            'study_program_id' => 1
        ]);


    }
}
