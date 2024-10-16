<?php

namespace App\Http\Requests\Package\Accessory;

use App\Enums\Locale;
use App\Models\Vehicle;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAccessoryRequest extends FormRequest
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
        $rules = [
            'category_id'   => ['required'],
            'merchant_id'   => ['required'],
            'purchase_price' => ['required'],
            'purchase_from' => ['required'],
            'user_id' => ['required'],
            'accessory_brand_id' => ['required'],
            'image'         => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:3072'],
            'quantity'      => ['required'],
            'priority'      => ['required'],
            'price'         => ['required'],
            'status'        => ['required', 'in:0,1'],
            'is_approved'   => ['required', 'in:0,1'],
            'publish_at'    => ['required', 'date'],
            'code'          => ['required', 'unique:accessories,code'],
        ];



        return $rule;
    }
}
