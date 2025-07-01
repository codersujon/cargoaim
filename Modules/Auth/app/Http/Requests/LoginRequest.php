<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'userId' => [
                'required',
                'string',
                'max:100',
            ],
            'password' => [
                'required',
                'string',
                'max:64'     // Prevent DoS via long inputs
            ],
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
     *  Custom Message
     */
    public function messages(): array
    {
        return [
            'userId.required' => 'Username is required.',
            'password.required' => 'Password is required.',
        ];
    }
}
