<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Models\Color;
use App\Traits\HttpResponses;

class ColorController
{
    use HttpResponses;
    /**
     * method for get all colors.
     * @return array|object
     */
    public function index(): array|object
    {
        $colors = Color::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($colors, '', 200);
    }
}
