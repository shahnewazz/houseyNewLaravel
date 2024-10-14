<?php

namespace Modules\Core\Http\Requests\SiteSetting;

use Illuminate\Foundation\Http\FormRequest;

class EmailUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'mail_from_name' => ['required', 'string', 'max:255'],
            'mail_from_address' => ['required', 'email', 'max:255'],
            'mail_driver' => ['required', 'string', 'max:255'],
            'mail_host' => ['required', 'string', 'max:255'],
            'mail_port' => ['required', 'string', 'max:255'],
            'mail_username' => ['required', 'string', 'max:255'],
            'mail_password' => ['required', 'string', 'max:255'],
            'mail_encryption' => ['required', 'string', 'max:255', 'in:ssl,tls'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'mail_from_name.required' => 'The sender name is required.',
            'mail_from_name.string' => 'The sender name must be a valid string.',
            'mail_from_name.max' => 'The sender name may not be greater than 255 characters.',

            'mail_from_address.required' => 'The sender email address is required.',
            'mail_from_address.email' => 'Please enter a valid email address for the sender.',
            'mail_from_address.max' => 'The sender email address may not be greater than 255 characters.',

            'mail_driver.required' => 'The mail driver is required (e.g., SMTP).',
            'mail_driver.string' => 'The mail driver must be a valid string.',
            'mail_driver.max' => 'The mail driver may not be greater than 255 characters.',

            'mail_host.required' => 'The mail host is required (e.g., smtp.mailtrap.io).',
            'mail_host.string' => 'The mail host must be a valid string.',
            'mail_host.max' => 'The mail host may not be greater than 255 characters.',

            'mail_port.required' => 'The mail port is required (e.g., 587 for TLS).',
            'mail_port.string' => 'The mail port must be a valid string.',
            'mail_port.max' => 'The mail port may not be greater than 255 characters.',

            'mail_username.required' => 'The mail username is required (e.g., your SMTP username).',
            'mail_username.string' => 'The mail username must be a valid string.',
            'mail_username.max' => 'The mail username may not be greater than 255 characters.',

            'mail_password.required' => 'The mail password is required.',
            'mail_password.string' => 'The mail password must be a valid string.',
            'mail_password.max' => 'The mail password may not be greater than 255 characters.',

            'mail_encryption.required' => 'The mail encryption type is required (e.g., SSL or TLS).',
            'mail_encryption.string' => 'The mail encryption must be a valid string.',
            'mail_encryption.max' => 'The mail encryption may not be greater than 255 characters.',
            'mail_encryption.in' => 'The mail encryption must be either SSL or TLS.',
        ];
    }

    
}
