<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\PageTranslation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'widgets', 'status', 'is_home'];

    protected $casts = [
        'widgets' => 'json'
    ];

    public function translations(){
        return $this->hasMany(PageTranslation::class);
    }
}
