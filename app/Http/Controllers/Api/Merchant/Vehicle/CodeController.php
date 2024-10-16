<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Models\Merchant;
use App\Models\Vehicle;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CodeController
{
    use HttpResponses;
    /**
     * method for get all codes.
     * @param Request $request
     * @return array|object
     */
    public function index(Request $request): array|object|string|bool
    {
        $merchantId = $request->user()->id;
        $codes = Vehicle::query()->where('merchant_id', $merchantId)->select('code')->get();

        foreach ($codes as $each) {
            $used_codes[] = $each->code;
        }

        $codes = Merchant::query()->select('id')
            ->with('code', fn ($query) => $query->whereNotIn('code', $used_codes)->select('merchant_id', 'prefix', 'code'))
            ->where('id', $merchantId)
            ->get();
        return $this->success($codes, '', 200);
    }
}
