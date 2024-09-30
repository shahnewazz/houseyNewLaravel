<?php

namespace Modules\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageUpdateRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:4', 'unique:language,code,' . $this->route('id')],
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
