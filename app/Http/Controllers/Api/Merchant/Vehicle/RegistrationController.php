<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Models\Registration;
use App\Traits\HttpResponses;

class RegistrationController
{
    use HttpResponses;
    /**
     * method for get all registrations.
     * @return array|object
     */
    public function index(): array|object
    {
        $registrations = Registration::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($registrations, '', 200);
    }
}
