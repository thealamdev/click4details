<?php

namespace App\Http\Requests\Package\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequirementRequest extends FormRequest
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
        $rule['name'] = ['nullable', 'string', 'max:100'];
        $rule['user_id'] = ['nullable'];
        $rule['merchant_id'] = ['nullable'];
        $rule['mobile'] = ['nullable', 'string'];
        $rule['email'] = ['nullable', 'email', 'string'];
        $rule['budget'] = ['nullable', 'numeric'];
        $rule['ready_budget'] = ['nullable', 'numeric'];
        $rule['loan'] = ['nullable', 'string'];
        $rule['bank_loan'] = ['nullable', 'numeric'];
        $rule['self_pay'] = ['nullable', 'numeric'];
        $rule['income']  = ['nullable', 'numeric'];
        $rule['company_transaction']  = ['nullable', 'numeric'];
        $rule['level']  = ['nullable', 'string'];
        $rule['serious']  = ['nullable', 'numeric'];
        $rule['profession']  = ['nullable', 'string'];
        $rule['frequency']  = ['nullable', 'numeric'];
        $rule['purchase_date']  = ['nullable', 'date'];
        $rule['location'] = ['nullable', 'string'];
        $rule['instraction'] = ['nullable', 'string', 'max:2000'];
        $rule['brand'] = ['required', 'array'];
        $rule['condition'] = ['nullable', 'array'];
        $rule['edition'] = ['nullable', 'array'];
        $rule['mileage_start'] = ['nullable', 'numeric'];
        $rule['mileage_end'] = ['nullable', 'numeric'];
        $rule['engine_start'] = ['nullable', 'numeric'];
        $rule['engine_end'] = ['nullable', 'numeric'];
        $rule['fuel'] = ['nullable', 'array'];
        $rule['skeleton'] = ['nullable', 'array'];
        $rule['transmission'] = ['nullable', 'array'];
        $rule['model'] = ['nullable', 'array'];
        $rule['color'] = ['nullable', 'array'];
        $rule['grade'] = ['nullable', 'array'];
        $rule['available'] = ['nullable', 'array'];
        $rule['registration'] = ['nullable', 'array'];
        $rule['feature'] = ['nullable', 'array'];

        return $rule;
    }
}
