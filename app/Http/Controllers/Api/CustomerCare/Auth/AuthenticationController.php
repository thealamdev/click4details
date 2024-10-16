<?php

namespace App\Http\Controllers\Api\CustomerCare\Auth;

use App\Models\Merchant;
use App\Models\CustomerCare;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\CustomerCare\LoginRequest;
use App\Http\Requests\Api\CustomerCare\RegisterRequest;

class AuthenticationController extends Controller
{
    use HttpResponses;

    /**
     * method for register customer care of merchant
     * @param RegisterRequest $request
     * @return array|object|string|bool
     */
    public function register(RegisterRequest $request): array|object|string
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $data['parent_type'] = Merchant::class;
        $data['parent_id'] = $request->user()->id;
        $customer_care = CustomerCare::create($data);

        return $this->success([
            'customer-care' => $customer_care,
            'token' => $customer_care->createToken('API Token of ' . $customer_care->name)->plainTextToken,
        ]);
    }

    /**
     *  login method for customer care.
     * @param LoginRequest $request
     * @return array|object|string|bool
     */
    public function login(LoginRequest $request): array|object|string|bool
    {
        $request->validated($request->all());
        if (!Auth::guard('customercare')->attempt($request->only(['mobile', 'password']))) {
            return $this->error('', 'Credentials do not match admin', 401);
        }

        $customercare = CustomerCare::where('mobile', $request->mobile)->first();
        return $this->success([
            'customercare' => $customercare,
            'token' => $customercare->createToken('API Token of' . $customercare->name)->plainTextToken,
        ]);
    }

    /**
     * Define a destroy method for delete Customer Care
     * @return bool
     */
    public function destroy(CustomerCare $customerCare)
    {
        $customerCare->delete();
        return $this->success([
            'success' => 'Customer Care Delete Successfully'
        ]);
    }
}
