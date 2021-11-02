<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Flush cache before seeding
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissions = [
            'user_list',
            'user_show',
            'user_update',
            'user_delete',
        ];

        $permissions = collect($arrayOfPermissions)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'api'];
        });

        Permission::insert($permissions->toArray());

        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'api'
        ]);

        Role::create([
            'name' => 'dosen',
            'guard_name' => 'api'
        ])->givePermissionTo($arrayOfPermissions);

        Role::create([
            'name' => 'mahasiswa',
            'guard_name' => 'api'
        ]);
    }
}
