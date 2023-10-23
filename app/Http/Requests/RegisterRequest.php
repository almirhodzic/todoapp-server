<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => 'required|string|max:1',
            'lastName'  => 'required|string|max:55',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:1',
            'passwordConfirm'   => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'firstName.max' => 'Max one char!',
        ];
    }
}
