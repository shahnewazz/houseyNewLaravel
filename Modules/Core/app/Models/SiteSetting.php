<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Core\Database\Factories\SiteSettingFactory;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value', 'additional_data'];

    protected $casts = [
        'additional_data' => 'array',
    ];

    // get value by key
    public static function getValue($key)
    {
        return self::where('key', $key)->first(['value'])->value;
    }
    public static function getAdditionalData($key)
    {
        return self::where('key', $key)->first(['additional_data'])->value;
    }

    // update value by key
    public static function setValue(string $key, string $value, array $additional_data = null)
    {

        $record = self::where('key', $key)->first();

        if ($record) {
            return $record->update([
                'value' => $value,
                'additional_data' => $additional_data,
            ]);
        }
    }
 
}
