<?php

namespace App\Http\Requests\Package\Residence;

use App\Enums\Locale;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompletionStatusRequest extends FormRequest
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
            $rule[$title]   = ['required', 'string'];
        }
        $rule['status']     = ['required', 'in:0,1'];
        return $rule;
    }
}
