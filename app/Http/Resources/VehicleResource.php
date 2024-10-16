<?php

namespace App\Http\Resources;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    /**
     * The resource that this resource collects
     * @var string
     */
    public string $collects = Vehicle::class;

    /**
     * The "data" wrapper that should be applied
     * @var string|null
     */
    public static $wrap = 'vehicles';

    /**
     * Transform the resource into an array
     * @return array<string, mixed>
     * @noinspection PhpUndefinedFieldInspection
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => (string) $this->id,
            'translate' => TranslateResource::collection($this->translate)
        ];
    }
}
