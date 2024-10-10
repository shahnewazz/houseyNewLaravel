<?php

namespace Modules\Core\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appName;
    public $fromName;
    public $fromEmail;
    public $recipientEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($appName, $fromName, $fromEmail, $recipientEmail)
    {
        $this->appName = $appName;
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->from($this->fromEmail, $this->fromName)
        ->to($this->recipientEmail)
        ->subject('Test Email from ' . $this->appName)
        ->view('core::emails.test-mail');
    }
}
