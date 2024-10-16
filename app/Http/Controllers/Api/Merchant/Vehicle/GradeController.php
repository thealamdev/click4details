<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Models\Grade;
use App\Traits\HttpResponses;

class GradeController
{
    use HttpResponses;
    /**
     * method for get all grades.
     * @return array|object
     */
    public function index(): array|object
    {
        $grades = Grade::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($grades, '', 200);
    }
}
