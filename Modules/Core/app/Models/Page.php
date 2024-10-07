<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'widgets', 'is_active', 'is_home'];

    protected $casts = [
        'widgets' => 'json'
    ];

    // Check if home page already exists
    public static function checkHomePage()
    {
        return self::where('is_home', 1)->exists();
    }
    


}
