<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Models\Available;
use App\Traits\HttpResponses;

class AvailableController
{
    use HttpResponses;
    /**
     * method for get all availables.
     * @return array|object
     */
    public function index(): array|object
    {
        $availables = Available::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($availables, '', 200);
    }
}
