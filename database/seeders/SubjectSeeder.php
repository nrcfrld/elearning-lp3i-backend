<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Campus;
use App\Models\Subject;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Pak Dosen 01',
            'identity_number' => '120120120',
            'birthplace' => 'Jakarta',
            'birthdate' => '2021-02-02 00:00:00',
            'gender' => 'Laki - Laki',
            'phone_number' => '0812312321',
            'address' => 'Jalan Jalan',
            'email' => 'pakdosen@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole('dosen');

        $campus = Campus::create([
            'name' => 'Pasar Minggu',
        ]);

        Subject::create([
            'name' => 'Pemrogramawan Web',
            'code' => 'PW001',
            'generation' => '2020',
            'campus_id' => $campus->id,
            'semester' => 4,
            'lecture_id' => $user->id,
            'sks' => 4,
            'day' => 'Senin',
            'start_at' => '08:00:00',
            'end_at' => '11:40:00'
        ]);
    }
}
