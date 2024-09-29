<?php

namespace Modules\Core\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Models\Language;

class LanguageRequest extends FormRequest
{

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
            'code' => ['required', 'string', 'max:4', 'unique:language,code'],
            'lang_img' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:512'],
            'direction' => ['required', 'in:ltr,rtl'],
        ];
    }

    public function messages()
    {
        return [
            'direction.in' => 'The direction must be either Left-to-Right (LTR) or Right-to-Left (RTL).',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Language Name',
            'code' => 'Language Code',
            'lang_img' => 'Language Image',
            'direction' => 'Direction',
        ];
    }

    
}
