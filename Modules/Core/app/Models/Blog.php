<?php

namespace Modules\Core\Models;

use Modules\Core\Models\Translation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    protected $fillable = ['title', 'slug'];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }
}
