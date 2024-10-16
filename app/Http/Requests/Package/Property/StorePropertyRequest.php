<?php

namespace App\Http\Requests\Package\Property;

use App\Enums\Locale;
use App\Models\Vehicle;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyRequest extends FormRequest
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
            'image'         => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:3072'],
            'priceunit_id'  => ['required'],
            'sizeunit_id'   => ['required'],
            'type_id'       => ['required'],
            'land_size'     => ['required'],
            'negotiable'    => ['required'],
            'priority'      => ['required'],
            'price'         => ['required'],
            'status'        => ['required', 'in:0,1'],
            'is_approved'   => ['required', 'in:0,1'],
            'publish_at'    => ['required', 'date'],
            'code'          => ['required', 'unique:properties,code'],
            'mobile'        => ['required'],
        ];
        
        
    
        return $rule;
    }
}
