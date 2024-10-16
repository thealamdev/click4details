<?php

namespace App\Http\Requests\Package\Vehicle;

use App\Enums\Locale;
use App\Models\Brand;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
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
        $rule['title']      = ['required', 'array'];
        foreach (Locale::iterator() as $lang) {
            $title          = sprintf('title.%s', $lang);
            $rule[$title]   = ['required', 'string', Rule::unique('translates', 'title')->where('translate_type', Brand::class)->where('local', $lang)->ignore($this->brand->id, 'translate_id')];
        }
        $rule['image']      = ['nullable', 'image', 'mimes:png,jpg', 'max:1024'];
        $rule['status']     = ['required', 'in:0,1'];
        return $rule;
    }
}
