<?php

namespace App\Http\Controllers\Api\Merchant\Vehicle;

use App\Traits\HttpResponses;
use App\Models\Skeleton;

class SkeletonController
{
    use HttpResponses;
    /**
     * method for get all skeletons.
     * @return array|object
     */
    public function index(): array|object
    {
        $skeletons = Skeleton::query()->select('id')
            ->with('translate', fn ($query) => $query->select('translate_id', 'title'))
            ->orderBy('slug','asc')
            ->get();
        return $this->success($skeletons, '', 200);
    }
}
