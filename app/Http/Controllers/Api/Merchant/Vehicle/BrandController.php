<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Traits\HttpResponses;
use App\Models\Brand;

class BrandController
{
    use HttpResponses;
    /**
     * method for get all brands.
     * @return array|object
     */
    public function index(): array|object
    {
        $brands = Brand::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($brands, '', 200);
    }
}
