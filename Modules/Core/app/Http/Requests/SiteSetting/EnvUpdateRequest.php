<?php

namespace Modules\Core\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class EnvUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'app_name' => ['required', 'string', 'max:255'],
            'app_debug' => ['required', 'string', 'max:255', 'in:true,false'],
            'app_env' => ['required', 'string', 'max:255', 'in:development,production'],
            'app_url' => ['required', 'url', 'max:255'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'app_url.url' => 'Please enter a valid URL.',
        ];
    }
}
