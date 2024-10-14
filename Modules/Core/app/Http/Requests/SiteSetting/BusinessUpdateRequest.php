<?php

namespace Modules\Core\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class BusinessUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'default_currency' => ['required', 'string', 'max:255'],
            'default_currency_position' => ['required', 'string', 'max:255', 'in:left,right'],
            'digit_after_decimal' => ['required', 'numeric', 'min:0', 'max:10'],
            'pagination_limit' => ['required', 'numeric', 'min:1', 'max:100'],
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
