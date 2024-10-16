<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Traits\HttpResponses;
use App\Models\Fuel;

class FuelController
{
    use HttpResponses;
    /**
     * method for get all fuels.
     * @return array|object
     */
    public function index(): array|object
    {
        $fuel = Fuel::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($fuel, '', 200);
    }
}
