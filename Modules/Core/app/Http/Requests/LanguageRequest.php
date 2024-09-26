<?php

namespace Modules\Core\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Models\Language;

class LanguageRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     *
     * This will sanitize the username before validation.
     */
    protected function prepareForValidation()
    {
        // Sanitize the username using the helper function before validation
        $this->merge([
            'code' => sanitize_username($this->username),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:4', Rule::unique(Language::class)->ignore($this->route('id'))],
            'direction' => ['required'],
        ];
    }

    
}
