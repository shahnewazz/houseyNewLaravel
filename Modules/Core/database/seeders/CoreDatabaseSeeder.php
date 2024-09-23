<?php

namespace Modules\Core\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' =>  bcrypt('password'),
        ]);

        $this->call([
            LanguageSeeder::class,
        ]);
    }
}
