<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Traits\HttpResponses;
use App\Models\Transmission;

class TransmissionController
{
    use HttpResponses;
    /**
     * method for get all transmissions.
     * @return array|object
     */
    public function index(): array|object
    {
        $transmissions = Transmission::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($transmissions, '', 200);
    }
}
