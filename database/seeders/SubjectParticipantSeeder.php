<?php

namespace Database\Seeders;

use App\Models\SubjectParticipant;
use Illuminate\Database\Seeder;

class SubjectParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(3)->create()->each(function ($user) {
            $user->assignRole('mahasiswa');

            SubjectParticipant::create([
                'user_id' => $user->id,
                'subject_id' => 1
            ]);
        });
    }
}
