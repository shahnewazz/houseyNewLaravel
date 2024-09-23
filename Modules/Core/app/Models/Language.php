<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\LanguageFactory;

class Language extends Model
{
    use HasFactory;

    protected $table = 'language';
    
    protected $fillable = ['name', 'code', 'direction', 'status', 'isDefault'];

}
