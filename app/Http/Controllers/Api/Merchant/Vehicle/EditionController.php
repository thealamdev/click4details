<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Traits\HttpResponses;
use App\Models\Edition;
use GuzzleHttp\Psr7\Request;

class EditionController
{
    use HttpResponses;
    /**
     * method for get all editions.
     * @return array|object
     */
    public function index(): array|object
    {
        $editions = Edition::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($editions, '', 200);
    }

    /**
     * method for edit all resources.
     * @param Request $request
     */
    public function edit(Request $request)
    {
        //TODO : emplements the method
    }
}
