<?php

namespace App\Http\Requests\Package\RentalServices;

use App\Enums\Locale;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Carmodel;
use App\Models\Merchant;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRentCarRequest extends FormRequest
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
        $rule['title']              = ['required', 'array'];
        foreach (Locale::iterator() as $lang) {
            $title                  = sprintf('title.%s', $lang);
            $rule[$title]           = ['required', 'string'];
        }
        $rule['brand_id'] =  ['required', Rule::exists(Brand::class, 'id')];
        $rule['merchant_id'] =  ['required', Rule::exists(Merchant::class, 'id')];
        $rule['carmodel_id'] =  ['required', Rule::exists(Carmodel::class, 'id')];
        $rule['color_id'] =  ['required', Rule::exists(Color::class, 'id')];
        $rule['image'] = ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:3072'];
        $rule['mileages'] = ['nullable'];
        $rule['status'] = ['nullable'];

        return $rule;
    }
}
