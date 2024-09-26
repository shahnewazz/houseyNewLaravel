<?php

namespace Modules\Core\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $super_admin = User::create([
            'first_name' => 'Shahnewaz',
            'last_name' => 'Sakil',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' =>  bcrypt('password'),
            'status' => 'active',
        ]);

        $permissions = [

            // Users
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            'users-show',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'default_user',
            'admin',
            'super_admin'
        ];

        foreach ($roles as $role){
            Role::create(['name' => $role]);
        }

        $super_admin->assignRole(['admin', 'super_admin', 'default_user']);
           
    }
}
