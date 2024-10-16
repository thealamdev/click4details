<?php

namespace App\Http\Controllers\Api\Merchant\Auth;

use App\Models\Merchant;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Merchant\LoginRequest;
use App\Http\Requests\Api\Merchant\RegisterRequest;
use App\Models\MerchantInfo;
use App\Models\User;

class AuthenticationController extends Controller
{
    use HttpResponses;

    /**
     * register method for merchant.
     * @param RegisterRequest $request
     * @return array|object|string|bool
     */
    public function register(RegisterRequest $request): array|object|string|bool
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $merchant = Merchant::create($data);
        MerchantInfo::create([
            'merchant_id'   => $merchant->getKey(),
            'company_name' => $request->company_name
        ]);

        return $this->success([
            'merchant' => $merchant,
            'token' => $merchant->createToken('API Token of ' . $merchant->name)->plainTextToken,
        ]);
    }

    /**
     * login method for merchant.
     * @param LoginRequest $request
     * @return array|object|string|bool
     */
    public function login(LoginRequest $request): array|object|string|bool
    {
        $request->validated();
        if (!Auth::attempt($request->only(['phone', 'password']))) {
            return $this->error('', 'Credentials do not match admin', 401);
        }

        $merchant = $request->user()->genre === 'M' ? $request->user() : null;
        if (isset($merchant) && $merchant instanceof User) {
            $merchant->tokens()->delete();
        }
        $apiToken = $merchant?->createToken('API Token of' . $merchant?->name)?->plainTextToken;
        return $this->success([
            'user' => $merchant,
            'token' => $apiToken,
        ]);
    }

    /**
     * Define a destroy method for delete merchant
     * @param User $merchant
     * @return array|object|string|bool
     */
    public function destroy(User $merchant): array|object|string|bool
    {
        $merchant->tokens()->delete();
        $merchant->delete();
        return $this->success([
            'success' => 'Merchant Delete Successfully'
        ]);
    }
}
