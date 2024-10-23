<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'menu_items', 'translations'];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'menu_items' => 'json',
        'translations' => 'json',
    ];
}
