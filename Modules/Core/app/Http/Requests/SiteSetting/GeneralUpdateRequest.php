<?php

namespace Modules\Core\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class GeneralUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'site_title' => 'required|string|max:255',
            'site_email' => 'required|email',
            'site_tagline' => 'required|string|max:255',
            'site_copyright' => 'required|string|max:255',
            'site_phone' => 'required|string|max:255',
            'site_address' => 'required|string|max:255',
            'site_latitude' => 'required|string|max:255',
            'site_longitude' => 'required|string|max:255',
            'site_timezone' => 'required|string|max:255',
            'site_date_format' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                // Get the available date formats from the config
                $availableFormats = array_keys(config('app.date_formats'));
    
                // Check if the provided value is in the available formats
                if (!in_array($value, $availableFormats)) {
                    $fail("The selected $attribute is invalid.");
                }
            }],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
