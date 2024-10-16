<?php

namespace App\Http\Requests\Package\Accessory;

use App\Enums\Locale;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShippingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request
     * @return array<string, ValidationRule|array|string>
     * @noinspection PhpUndefinedFieldInspection
     */
    public function rules(): array
    {
         return [
            'name' => 'required',
            'name' => 'required',
            'charge' => 'required'
         ];
    }
}
