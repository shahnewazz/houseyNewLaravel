<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\MailTemplateFactory;

class MailTemplate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public static function templateSubject()
    {
        return [
            'welcome' => 'Welcome',
            'password_reset' => 'Password Reset',
            'verify_email' => 'Verify Email',
        ];
    }
}
