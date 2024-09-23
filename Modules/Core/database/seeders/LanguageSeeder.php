<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Models\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            'name' => 'English',
            'code' => 'en',
            'direction' => 'ltr',
            'status' => 1,
            'isDefault' => 1,
        ]);
    }
}
