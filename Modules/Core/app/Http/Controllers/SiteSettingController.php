<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Core\Emails\TestMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class SiteSettingController extends Controller
{
    // email settings
    public function emailSettings()
    {
        return view("core::pages.settings.email");
    }

    public function testMail(){

        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.host' => 'sandbox.smtp.mailtrap.io',
            'mail.mailers.smtp.port' => '2525',
            'mail.mailers.smtp.username' => 'b7c3e7c96ea8fc',
            'mail.mailers.smtp.password' => '6f2b9d257cb90c',
            'mail.mailers.smtp.encryption' => 'tls',
            'mail.from.address' => 'shahnewaz@gmail.com',
            'mail.from.name' => 'Shahnewaz',
        ]);

        $appName = config('app.name'); // Assuming you have your app name in config/app.php
        $fromName = 'Shahnewaz';
        $fromEmail = 'shahnewaz@gmail.com';
        $recipientEmail = 'shahnewaz720@gmail.com';
    
        // Dispatch the email to the queue
        try {
            Mail::to($recipientEmail)->queue(new TestMail($appName, $fromName, $fromEmail, $recipientEmail));
            // Queue::push(new TestMail($appName, $fromName, $fromEmail, $recipientEmail));
            return redirect()->back()->with('success', 'Test email has been queued successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to queue the test email: ' . $e->getMessage());
        }
        



        // Mail::raw('This is a test email', function ($message) {
        //     $message->to('shahnewaz720@gmail.com')->subject('Test Email');
        // });
        // return redirect()->back()->with('success', 'Test email has been queued successfully!');
    }

    // payment settings
    public function paymentSettings(){
        return view("core::pages.settings.payment");
    }
}
