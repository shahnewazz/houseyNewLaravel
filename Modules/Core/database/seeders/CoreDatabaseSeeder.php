<?php

namespace Modules\Core\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\Core\Database\Seeders\RolePermissionSeeder;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
        User::create([
            'first_name' => 'Shahnewaz',
            'last_name' => 'Sakil',
            'username' => 'super_admin',
            'email' => 'admin@gmail.com',
            'password' =>  bcrypt('password'),
            'status' => 'active',
            'user_type' => 'admin',
        ]);

        $this->call([
            LanguageSeeder::class,
            RolePermissionSeeder::class
        ]);

        User::factory()->count(30)->create();
    }
}
