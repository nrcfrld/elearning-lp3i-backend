<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'Staff Akademik PSM',
            'identity_number' => '123123123',
            'birthplace' => 'Jakarta',
            'birthdate' => '2021-02-02 00:00:00',
            'gender' => 'Laki - Laki',
            'phone_number' => '0812312321',
            'role' => 'ADMIN',
            'address' => 'Jalan Jalan',
            'email' => 'akademikpsm@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
    }
}
