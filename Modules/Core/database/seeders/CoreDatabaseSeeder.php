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
    
        User::factory()->count(10)->create();

        $this->call([
            LanguageSeeder::class,
            RolePermissionSeeder::class
        ]);
    }
}
