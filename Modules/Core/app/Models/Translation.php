<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translation extends Model
{

    protected $fillable = ['translatable_id', 'translatable_type', 'language_code', 'field_name', 'content'];

    public function translatable()
    {
        return $this->morphTo();
    }

}
