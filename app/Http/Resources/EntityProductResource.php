<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntityProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $response = [];
        foreach ($this->entities as $entity) {
            $response[] = [
                'id' => $this->id,
                'slug' => $this->slug,
                'edition_id' => $this->edition_id,
                'feature' => [
                    'id'    => $entity->feature->id,
                    'title' => $entity->feature->title,
                ],
                'detail' => [
                    'id'    => $entity->id,
                    'title' => $entity->title,
                ]
            ];
        }
        return $response;
    }
}
