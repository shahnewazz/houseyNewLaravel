<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Core\Enums\SiteSettingEnum;
use Modules\Core\Http\Requests\SiteSetting\BusinessUpdateRequest;
use Modules\Core\Http\Requests\SiteSetting\EmailUpdateRequest;
use Modules\Core\Http\Requests\SiteSetting\EnvUpdateRequest;
use Modules\Core\Http\Requests\SiteSetting\GeneralUpdateRequest;
use Modules\Core\Http\Requests\SiteSetting\InterfaceUpdateRequest;
use Modules\Core\Jobs\TestMailJob;
use Modules\Core\Models\SiteSetting;

class SiteSettingController extends Controller
{

    protected function updateSiteSettings($data)
    {
        foreach ($data as $key => $value) {
            SiteSetting::setValue($key, $value);
        }
    }

    // general settings
    public function updateGeneralSettings(GeneralUpdateRequest $request)
    {
       $this->updateSiteSettings($request->validated());

       return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    // business settings
    public function updateBusinessSettings(BusinessUpdateRequest $request)
    {
        $this->updateSiteSettings($request->validated());

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }

    // interface settings
    public function updateInterfaceSettings(Request $request)
    {
        
        $validated = $request->validate([
            'site_primary_color' => ['required', 'string', 'max:255'],
            'site_secondary_color' => ['required', 'string', 'max:255'],
            'site_body_color' => ['required', 'string', 'max:255'],
            'site_heading_color' => ['required', 'string', 'max:255'],
            'site_preloader' => ['nullable', 'string', 'max:255'],
            'site_preloader_overlay' => ['required', 'string', 'max:255'],
            'site_logo_width' => ['required', 'string', 'max:255'],
        ]);

        $config = new SiteSetting();
        $config->setValue('site_primary_color', $validated['site_primary_color']);
        $config->setValue('site_secondary_color', $validated['site_secondary_color']);
        $config->setValue('site_body_color', $validated['site_body_color']);
        $config->setValue('site_heading_color', $validated['site_heading_color']);
        $config->setValue('site_preloader', $validated['site_preloader'] ?? 'off');
        $config->setValue('site_preloader_overlay', $validated['site_preloader_overlay']);
        $config->setValue('site_logo_width', $validated['site_logo_width']);

        if($request->hasFile('site_logo')){

            $siteLogo = $request->file('site_logo');
            $path = updateMedia($siteLogo, null, SiteSettingEnum::SITE_INTERFACE_MEDIA_DIR, 'public', true);
            SiteSetting::setValue('site_logo', $path);
        }

        if($request->hasFile('site_logo_secondary')){
            $siteLogoSecondary = $request->file('site_logo_secondary');
            $path = updateMedia($siteLogoSecondary, null, SiteSettingEnum::SITE_INTERFACE_MEDIA_DIR, 'public', true);
            SiteSetting::setValue('site_logo_secondary', $path);
        }

        if($request->hasFile('site_favicon')){
            $siteFavicon = $request->file('site_favicon');
            $path = updateMedia($siteFavicon, null, SiteSettingEnum::SITE_INTERFACE_MEDIA_DIR, 'public', true);
            SiteSetting::setValue('site_favicon', $path);
        }
        

        return redirect()->back()->with('success', 'Settings updated successfully!');
        
    }


    // email settings
    public function emailSettings()
    {
        return view("core::pages.settings.email");
    }

    public function updateEmailSettings(EmailUpdateRequest $request){
        $this->updateSiteSettings($request->validated());

        $email_vars = [
            'MAIL_MAILER'=> $request->mail_driver,
            'MAIL_HOST'=> $request->mail_host,
            'MAIL_PORT'=> $request->mail_port,
            'MAIL_USERNAME'=> $request->mail_username,
            'MAIL_PASSWORD'=> $request->mail_password,
            'MAIL_ENCRYPTION'=> $request->mail_encryption,
            'MAIL_FROM_ADDRESS'=> $request->mail_from_address,
            'MAIL_FROM_NAME'=> $request->mail_from_name,
        ];
        if(updateMultiEnv($email_vars)){
            return redirect()->back()->with('success', 'Settings updated successfully!');
        }
        return redirect()->back()->with('error', 'Failed to update settings!');
    }

    public function testMail(Request $request){
        $request->validate([
            'recipient_email' => ['required', 'email', 'max:255'],
        ],
        [
            'recipient_email.email' => 'Please enter a valid email address.',
            'recipient_email.required' => 'Recipient email is required.',
        ]);
        $appName = config('app.name');
        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $recipientEmail = $request->recipient_email;
       
        try {
            dispatch(new TestMailJob($appName, $fromName, $fromEmail, $recipientEmail));
            return redirect()->back()->with('success', 'Test email has been queued successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to queue the test email: ' . $e->getMessage());
        }
    }

    // payment settings
    public function paymentSettings(){
        return view("core::pages.settings.payment");
    }


    // environment settings
    public function envSettings(){
        return view("core::pages.settings.env");
    }

    public function updateEnvSettings(EnvUpdateRequest $request)
    {
        $this->updateSiteSettings($request->validated());

        $env_vars = [
            'APP_NAME' => $request->app_name,
            'APP_DEBUG' => $request->app_debug,
            'APP_ENV' => $request->app_mode,
            'APP_URL' => $request->app_url,
        ];

        if(updateMultiEnv($env_vars)){
            return redirect()->back()->with('success', 'Settings updated successfully!');
        }
        return redirect()->back()->with('error', 'Failed to update settings!');

    }
}
