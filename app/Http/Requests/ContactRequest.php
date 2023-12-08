<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class ContactRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3|max:15',
            'last_name' => 'required|string|min:3|max:15',
            'email' => [
                'required',
                'email',
                Rule::unique('contact_information')->ignore($this->route('id'))
            ],
            'phone_number' => ['nullable','digits:8' ,'regex:/^(70|03|71|81)\d{6}$/']
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'The first name is required.',
            'first_name.string' => 'The first name must be a string.',
            'first_name.min' => 'The first name must be at least 3 characters.',
            'first_name.max' => 'The first name must not exceed 15 characters.',

            'last_name.required' => 'The last name is required.',
            'last_name.string' => 'The last name must be a string.',
            'last_name.min' => 'The last name must be at least 3 characters.',
            'last_name.max' => 'The last name must not exceed 15 characters.',

            'email.required' => 'The email is required.',
            'email.unique' => 'The email has already been taken.',
            'email.email' => 'The email must be a valid email address.',

            'phone_number.digits' => 'The phone number must be 8 digits.',
            'phone_number.regex' => 'The phone number must start with 70, 03, 71, or 81 followed by 6 digits.',
        ];
    }
}
