<?php

namespace App\Http\Requests\Package\Vehicle;

use App\Enums\Locale;
use App\Models\Vehicle;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVehicleRequest extends FormRequest
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
     * @noinspection DuplicatedCode
     */
    public function rules(): array
    {
        $rule['title']              = ['required', 'array'];
        foreach (Locale::iterator() as $lang) {
            $title                  = sprintf('title.%s', $lang);
            $rule[$title]           = ['required', 'string'];
        }
        $rule['user_id']           = ['required'];
        $rule['category_id']        = ['required', 'exists:categories,id'];
        $rule['merchant_id']        = ['required', 'exists:merchants,id'];
        $rule['brand_id']           = ['required', 'exists:brands,id'];
        $rule['condition_id']       = ['required', 'exists:conditions,id'];
        $rule['transmission_id']    = ['required', 'exists:transmissions,id'];
        $rule['engine_id']          = ['nullable'];
        $rule['engines']            = ['required'];
        $rule['edition_id']         = ['required', 'exists:editions,id'];
        $rule['fuel_id']            = ['required', 'exists:fuels,id'];
        $rule['skeleton_id']        = ['required', 'exists:skeletons,id'];
        $rule['mileage_id']         = ['nullable'];
        $rule['mileages']           = ['required'];
        $rule['registration']       = ['date_format:Y'];
        $rule['manufacture']        = ['required', 'date_format:Y'];
        $rule['image']              = ['required', 'image', 'mimes:png,jpg,jpeg', 'max:3072'];
        $rule['is_feat']            = ['required', 'in:0,1'];
        $rule['status']             = ['required', 'in:0,1'];
        $rule['is_approved']        = ['required', 'in:0,1'];
        $rule['publish_at']         = ['required', 'date'];
        $rule['code']               = ['required', 'unique:vehicles,code'];
        $rule['available_id']       = ['required'];
        $rule['registration_id']    = ['required'];
        $rule['carmodel_id']        = ['required'];
        $rule['color_id']           = ['required'];
        $rule['fixed_price']        = ['required'];
        $rule['price']              = ['required'];
        $rule['engine_number']      = ['nullable'];
        $rule['chassis_number']     = ['required'];

        return $rule;
    }
}
