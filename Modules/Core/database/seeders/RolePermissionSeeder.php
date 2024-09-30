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

        $super_admin = User::findOrFail(1);

        $permissions = [

            // Users
            'users-show',
            'users-create',
            'users-edit',
            'users-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }       
        

        $super_admin_role = Role::create(['name' => 'super_admin']);

        $super_admin_role->syncPermissions($permissions);

        $super_admin->assignRole(['super_admin']);
           
    }
}
