<?php

namespace App\Http\Requests\Package\Vehicle;

use App\Enums\Locale;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDescriptionRequest extends FormRequest
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
        $rule['description']    = ['required', 'array'];
        foreach (Locale::iterator() as $lang) {
            $description        = sprintf('description.%s', $lang);
            $rule[$description] = ['required', 'string'];
        }
        return $rule;
    }
}
