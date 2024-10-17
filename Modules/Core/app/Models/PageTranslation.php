<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\PageTranslationFactory;

class PageTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'code', 'content'];

    protected $casts = [
        'content' => 'json',
    ];

    public function translations()
    {
        return $this->belongsTo(Page::class);
    } 
}
