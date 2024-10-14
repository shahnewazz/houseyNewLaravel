<?php

namespace Modules\Core\Jobs;

use Illuminate\Bus\Queueable;
use Modules\Core\Emails\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class TestMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appName;
    protected $fromName;
    protected $fromEmail;
    protected $recipientEmail;

    /**
     * Create a new job instance.
     */
    public function __construct($appName, $fromName, $fromEmail, $recipientEmail)
    {
        $this->appName = $appName;
        $this->fromName = $fromName;
        $this->fromEmail = $fromEmail;
        $this->recipientEmail = $recipientEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->recipientEmail)->send(new TestMail($this->appName, $this->fromName, $this->fromEmail, $this->recipientEmail));
    }
}
