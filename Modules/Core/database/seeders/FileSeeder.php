<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Modules\Core\Enums\SiteSettingEnum;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourcePath = module_path('Core', 'Database/seeders/files');
        $targetPath = SiteSettingEnum::SITE_INTERFACE_MEDIA_DIR; 

        Storage::disk('public')->makeDirectory($targetPath);

        $files = ['logo.png', 'logo-2.png', 'favicon.png'];

        foreach ($files as $file) {
            $sourceFile = $sourcePath . '/' . $file;
            $targetFile = $targetPath . '/' . $file;

            if (file_exists($sourceFile)) {
                Storage::disk('public')->put($targetFile, file_get_contents($sourceFile), 'public');
                $this->command->info("Seeded file: {$targetFile}");
            } else {
                $this->command->error("File not found: {$sourceFile}");
            }
        }
    }
}
