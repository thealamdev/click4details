<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Models\Vehicle;
use App\Traits\HttpResponses;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Package\Vehicle\StoreDescriptionRequest;

class DescriptionController
{
    use HttpResponses;
    /**
     * Store a newly created resource in storage
     * @param  Vehicle                 $vehicle
     * @param  StoreDescriptionRequest $request
     * @return RedirectResponse
     */
    public function store(Vehicle $vehicle, StoreDescriptionRequest $request)
    {
        if ($request->validated()) {
            $isManage = collect($request->input('description'))->each(fn ($each, $lang) => $vehicle->description()->updateOrCreate(['local' => $lang], ['content' => $each, 'local' => $lang]));
            $response = $isManage ? 'Congrats! Data is processed successfully' : 'Oops! Unable to process record';
            return $this->success($response, '', 200);
        }
    }
}
