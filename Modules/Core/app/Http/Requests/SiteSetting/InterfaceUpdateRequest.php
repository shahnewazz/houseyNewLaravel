<?php

namespace Modules\Core\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class InterfaceUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'site_primary_color' => ['required', 'string', 'max:255'],
            'site_secondary_color' => ['required', 'string', 'max:255'],
            'site_body_color' => ['required', 'string', 'max:255'],
            'site_heading_color' => ['required', 'string', 'max:255'],
            'site_preloader' => ['required'],
            'site_preloader_overlay' => ['required', 'string', 'max:255'],
            'site_logo_width' => ['required', 'string', 'max:255'],
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
