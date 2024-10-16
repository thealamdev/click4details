<?php

namespace App\Http\Requests\Package\Vehicle;

use App\Enums\Locale;
use App\Models\Color;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreColorRequest extends FormRequest
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
        $rule['title']      = ['required', 'array'];
        foreach (Locale::iterator() as $lang) {
            $title          = sprintf('title.%s', $lang);
            $rule[$title]   = ['required', 'string', Rule::unique('translates', 'title')->where('translate_type', Color::class)->where('local', $lang)];
        }
        $rule['status']     = ['required', 'in:0,1'];
        return $rule;
    }
}
