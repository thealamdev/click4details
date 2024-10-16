<?php

namespace App\Http\Requests\Api\Merchant;

use Illuminate\Validation\Rules\Password;
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
            'name' => ['required', 'string'],
            'company_name' => ['required', 'string'],
            'mobile' => ['required', 'string', 'unique:merchants'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
