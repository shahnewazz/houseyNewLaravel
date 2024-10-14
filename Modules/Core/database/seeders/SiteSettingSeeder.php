<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Core\Enums\EmailEnum;
use Modules\Core\Enums\EnvEnum;
use Modules\Core\Models\SiteSetting;
use Modules\Core\Enums\SiteSettingEnum;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $settings = [
            ['key' => SiteSettingEnum::SITE_TITLE, 'value' => 'Themepure'],
            ['key' => SiteSettingEnum::SITE_TAGLINE, 'value' => 'We are a creative agency'],
            ['key' => SiteSettingEnum::SITE_DESCRIPTION, 'value' => 'Themepure is a creative agency that specializes in branding, web design, and digital marketing.'],
            ['key' => SiteSettingEnum::SITE_COPYRIGHT, 'value' => 'Copyright © 2024 Themepure'],
            ['key' => SiteSettingEnum::SITE_EMAIL, 'value' => 'admin@gmail.com'],
            ['key' => SiteSettingEnum::SITE_PHONE, 'value' => '01602052805'],
            ['key' => SiteSettingEnum::SITE_ADDRESS, 'value' => 'Mirpur, Dhaka, Bangladesh'],
            ['key' => SiteSettingEnum::SITE_LATITUDE, 'value' => '23.829540'],
            ['key' => SiteSettingEnum::SITE_LONGITUDE, 'value' => '90.370548'],
            ['key' => SiteSettingEnum::SITE_TIMEZONE, 'value' => 'UTC'],
            ['key' => SiteSettingEnum::SITE_DATE_FORMAT, 'value' => 'M d, Y'],

            // Business settings
            ['key' => SiteSettingEnum::DEFAULT_CURRENCY, 'value' => 'usd'],
            ['key' => SiteSettingEnum::DEFAULT_CURRENCY_POSITION, 'value' => 'left'],
            ['key' => SiteSettingEnum::DIGIT_AFTER_DECIMAL, 'value' => '2'],
            ['key' => SiteSettingEnum::PAGINATION_LIMIT, 'value' => '10'],

            // Site interface
            ['key' => SiteSettingEnum::SITE_PRIMARY_COLOR, 'value' => '#B7124D'],
            ['key' => SiteSettingEnum::SITE_SECONDARY_COLOR, 'value' => '#d59020'],
            ['key' => SiteSettingEnum::SITE_BODY_COLOR, 'value' => '#5A5859'],
            ['key' => SiteSettingEnum::SITE_HEADING_COLOR, 'value' => '#141414'],

            ['key' => SiteSettingEnum::SITE_LOGO, 'value' => SiteSettingEnum::SITE_INTERFACE_MEDIA_DIR.'/logo.png'],
            ['key' => SiteSettingEnum::SITE_LOGO_SECONDARY, 'value' => SiteSettingEnum::SITE_INTERFACE_MEDIA_DIR.'/logo-2.png'],
            ['key' => SiteSettingEnum::SITE_LOGO_WIDTH, 'value' => '120'],
            ['key' => SiteSettingEnum::SITE_FAVICON, 'value' => SiteSettingEnum::SITE_INTERFACE_MEDIA_DIR.'/favicon.png'],

            ['key' => SiteSettingEnum::SITE_PRELOADER, 'value' => '1'],
            ['key' => SiteSettingEnum::SITE_PRELOADER_OVERLAY, 'value' => '#a05916'],

            // ENV
            ['key' => EnvEnum::APP_URL, 'value' => 'http://localhost:8000'], // Keep as string if not enum
            ['key' => EnvEnum::APP_NAME, 'value' => 'Themepure'],
            ['key' => EnvEnum::APP_DEBUG, 'value' => 'true'],
            ['key' => EnvEnum::APP_ENV, 'value' => 'development'],

            // email
            ['key' => EmailEnum::MAIL_DRIVER, 'value' => 'smtp'],
            ['key' => EmailEnum::MAIL_HOST, 'value' => 'sandbox.smtp.mailtrap.io'],
            ['key' => EmailEnum::MAIL_PORT, 'value' => '2525'],
            ['key' => EmailEnum::MAIL_USERNAME, 'value' => 'b7c3e7c96ea8fc'],
            ['key' => EmailEnum::MAIL_PASSWORD, 'value' => '6f2b9d257cb90c'],
            ['key' => EmailEnum::MAIL_ENCRYPTION, 'value' => 'tls'],
            ['key' => EmailEnum::MAIL_FROM_ADDRESS, 'value' => 'shahnewaz@gmail.com'],
            ['key' => EmailEnum::MAIL_FROM_NAME, 'value' => config('app.name')],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }

        $env_vars = [
            'APP_NAME' => 'Themepure',
            'APP_DEBUG' => 'true',
            'APP_ENV' => 'development',
            'APP_URL' => 'http://localhost:8000',
        ];

        $email_vars = [
            'MAIL_MAILER'=>'smtp',
            'MAIL_HOST'=>'sandbox.smtp.mailtrap.io',
            'MAIL_PORT'=>'2525',
            'MAIL_USERNAME'=>'b7c3e7c96ea8fc',
            'MAIL_PASSWORD'=>'6f2b9d257cb90c',
            'MAIL_ENCRYPTION'=>'tls',
            'MAIL_FROM_ADDRESS'=>'shahnewaz@gmail.com',
            'MAIL_FROM_NAME'=> config('app.name'),
        ];

        updateMultiEnv($env_vars);
        updateMultiEnv($email_vars);

    }
}
