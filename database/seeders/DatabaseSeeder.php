<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $permission1 = Permission::create(['name' => 'role-index']);
        $permission2 = Permission::create(['name' => 'role-store']);
        $permission3 = Permission::create(['name' => 'role-update']);
        $permission4 = Permission::create(['name' => 'role-destroy']);
        $permission5 = Permission::create(['name' => 'permission-index']);
        $permission6 = Permission::create(['name' => 'permission-store']);
        $permission7 = Permission::create(['name' => 'permission-update']);
        $permission8 = Permission::create(['name' => 'permission-destroy']);
        $role = Role::create(['name' => 'Admin']);
        $role->syncPermissions([$permission1, $permission2, $permission3, $permission4, $permission5, $permission6, $permission7, $permission8]);
        $user = User::factory()->create([
            'name' => 'Mike POnce',
            'email' => 'mike@example.com',
            'password' => bcrypt('123123')
        ]);
        $user->assignRole($role);
    }
}
