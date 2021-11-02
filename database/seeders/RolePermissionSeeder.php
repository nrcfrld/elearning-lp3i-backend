<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'dosen',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'mahasiswa',
            'guard_name' => 'api'
        ]);
    }
}
