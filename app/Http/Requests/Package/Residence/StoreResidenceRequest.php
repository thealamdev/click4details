<?php

namespace App\Http\Requests\Package\Residence;

use App\Enums\Locale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class StoreResidenceRequest extends FormRequest
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
        $rule['title']              = ['required', 'array'];
        foreach (Locale::iterator() as $lang) {
            $title                  = sprintf('title.%s', $lang);
            $rule[$title]           = ['required', 'string'];
        }
        $rule['merchant_id'] = ['required', 'exists:merchants,id'];
        $rule['completion_status_id'] = ['required', 'exists:completion_statuses,id'];
        $rule['furnished_status_id'] = ['required', 'exists:furnished_statuses,id'];
        $rule['apartment_complex_id'] = ['required', 'exists:apartment_complexes,id'];
        $rule['unit_price'] = ['required'];
        $rule['price'] = ['required'];
        $rule['bedrooms'] = ['required'];
        $rule['bathrooms'] = ['required'];
        $rule['address'] = ['required'];
        $rule['negotiable'] = ['required'];
        $rule['image'] = ['required', 'image', 'mimes:png,jpg,jpeg', 'max:3072'];
        $rule['mobile'] = ['nullable'];

        return $rule;
    }
}
