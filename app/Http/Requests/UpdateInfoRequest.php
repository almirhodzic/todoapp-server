<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
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
            'firstName' => 'filled|string|max:255',
            'lastName' => 'filled|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'firstName.filled' => 'Name First muss angegeben werden.',
            'firstName.string' => 'Name First muss ein String sein.',
            'firstName.max' => 'Name First darf nicht grösser als :max sein.',
            'lastName.filled' => 'Name Last muss angegeben werden.',
            'lastName.string' => 'Name Last muss ein String sein.',
            'lastName.max' => 'Name Last darf nicht grösser als :max sein.',
        ];
    }
}

