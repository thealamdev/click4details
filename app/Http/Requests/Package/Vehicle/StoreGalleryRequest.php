<?php

namespace App\Http\Requests\Package\Vehicle;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
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
     */
    

    public function rules(): array
    {
        return [
            'image' => ['required', 'array'],
            'image.*' => ['image', 'mimes:png,jpg,jpeg', 'max:3072']
        ];
    }
}
