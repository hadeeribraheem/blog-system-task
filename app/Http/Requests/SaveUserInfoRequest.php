<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUserInfoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|string|max:50|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 3 characters.',
            'name.max' => 'The name must not exceed 50 characters.',
            'name.regex' => 'The name may only contain letters and spaces.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters.',
        ];
    }

}
