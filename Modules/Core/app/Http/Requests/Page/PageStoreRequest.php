<?php

namespace Modules\Core\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'regex:/^[a-zA-Z0-9-]+$/', 'max:255', 'unique:pages'],
            'widgets' => ['nullable', 'json'],
            'status' => ['required', 'in:active,inactive,draft'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'slug.regex' => 'The slug may only contain letters, numbers, and dashes.',
        ];
    }
}
