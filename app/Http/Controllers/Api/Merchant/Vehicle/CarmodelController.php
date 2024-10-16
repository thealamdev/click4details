<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Traits\HttpResponses;
use App\Models\Carmodel;
use Illuminate\Support\Facades\DB;

class CarmodelController
{
    use HttpResponses;
    /**
     * method for get all models.
     * @return array|object
     */
    public function index(): array|object
    {
        $models = Carmodel::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($models, '', 200);
    }
}