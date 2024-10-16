<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Traits\HttpResponses;
use App\Models\Condition;

class ConditionController
{
    use HttpResponses;
    /**
     * method for get all conditions.
     * @return array|object
     */
    public function index(): array|object
    {
        $conditions = Condition::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($conditions, '', 200);
    }
}
