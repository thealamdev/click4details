<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'priority'          => $this->priority,
            'color_id'          => $this->color->id,
            'merchant_id'       => $this->merchant->id,
            'carmodel_id'       => $this->sketch->id,
            'slug'              => $this->slug,
            'engine_number'     => $this->statement->engine,
            'brand_id'          => $this->brand->id,
            'grade_id'          => $this->grade->id,
            'edition_id'        => $this->edition->id,
            'condition_id'      => $this->condition->id,
            'chassis_number'    => $this->statement->chassis,
            'video'             => $this->video,
            'transmission_id'   => $this->transmission->id,
            'fuel_id'           => $this->fuel->id,
            'skeleton_id'       => $this->skeleton->id,
            'available_id'      => $this->availability->id,
            'purchase_price'    => $this->price->purchase,
            'fixed_price'       => $this->price->fixed,
            'price'             => $this->price->asking,
            'mileages'          => $this->statement->mileage,
            'engines'           => $this->statement->engine,
            'code'              => $this->code,
            'registration'      => $this->statement->registration,
            'manufacture'       => $this->statement->manufacture,
            'merchant'          => [
                'id'            => $this->merchant->id,
                'name'          => $this->merchant->name,

            ],
            'title'             => $this->title,
            'brand'             => [
                'id' => $this->brand->id,
                'title' => $this->brand->title,
            ],
            'carmodel' => [
                'id' => $this->sketch->id,
                'title' => $this->sketch->title
            ],
            'color' => [
                'id' => $this->color->id,
                'title' => $this->color->title
            ],
            'edition' => [
                'id' => $this->edition->id,
                'title' => $this->edition->title,
            ],
            'condition' => [
                'id' => $this->condition->id,
                'title' => $this->condition->title,
            ],
            'transmission' => [
                'id' => $this->transmission->id,
                'title' => $this->transmission->title,
            ],
            'grade' => [
                'id' => $this->grade->id,
                'title' => $this->grade->title,
            ],
            'fuel' => [
                'id' => $this->fuel->id,
                'title' => $this->fuel->title,
            ],
            'skeleton' => [
                'id' => $this->skeleton->id,
                'title' => $this->skeleton->title,
            ],
            'availability' => [
                'id' => $this->availability->id,
                'title' => $this->availability->title,
            ],
        ];
    }
}
