<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User([
            'name' => $row['name'],
            'identity_number' =>$row['identity_number'],
            'birthplace' => $row['birthplace'],
            'birthdate' => $row['birthdate'],
            'gender' => $row['gender'],
            'phone_number' => $row['phone_number'],
            'address' => $row['address'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'classroom_id' => $row['classroom_id'],
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('mahasiswa');

        return $user;
    }
}
