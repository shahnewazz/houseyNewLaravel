<?php

namespace Modules\Core\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'regex:/^[a-zA-Z0-9-]+$/', 'max:255', "unique:pages,slug,". $this->id],
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
}
