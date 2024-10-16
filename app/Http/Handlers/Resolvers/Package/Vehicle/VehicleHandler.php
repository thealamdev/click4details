<?php

namespace App\Http\Handlers\Resolvers\Package\Vehicle;

use App\Enums\Bucket;
use App\Models\Brand;
use App\Facades\Upload;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Handlers\Adapters\HandlerAdapter;

class VehicleHandler extends HandlerAdapter
{
    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array|object|int|string|bool
    {
        $isUpload = Upload::local()->store($request, Bucket::VEHICLE);
        $instance = Vehicle::query()->create(array_merge_recursive($request->only('user_id', 'category_id', 'merchant_id', 'brand_id', 'edition_id', 'condition_id', 'transmission_id', 'engines', 'fuel_id', 'skeleton_id', 'mileages', 'grade_id', 'registration', 'manufacture', 'purchase_price', 'fixed_price', 'additional_price', 'price', 'is_approved', 'publish_at', 'is_feat', 'status', 'color_id', 'carmodel_id', 'code', 'available_id', 'registration_id', 'prioty', 'video', 'engine_number', 'chassis_number', 'negotiable'), [
            'slug' => $this->makeSlugString($request->input('title')) . uniqid()
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }

    /**
     * Handle the incoming delete request
     * @param  Model|Request                $instance
     * @param  bool|null                    $isForceDelete
     * @return array|object|int|string|bool
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     * @noinspection PhpUndefinedFieldInspection
     */
    public function erase(Model|Request $instance, ?bool $isForceDelete = false): array|object|int|string|bool
    {
        $process = $instance instanceof Model ? $instance : Brand::query()->findOrFail($instance->product);
        if (isset($process->image) && !empty($process->image)) {
            $process->image->recycle();
            $process->image()?->delete();
        }
        if (isset($process->gallery) && !empty($process->gallery)) {
            foreach ($process->gallery as $gallery) {
                $gallery->recycle();
                $gallery->delete();
            }
        }
        collect($process->translate)->map(fn ($i) => $i->delete());
        collect($process->description)->map(fn ($i) => $i->delete());
        return $process->delete();
    }

    /**
     * Handle the incoming restore request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function repay(Request $request): array|object|int|string|bool
    {
        return false;
    }

    /**
     * Handle the incoming update request
     * @param  Request                      $request
     * @param  Model|int|string             $instance
     * @return array|object|int|string|bool
     */
    public function adapt(Request $request, Model|int|string $instance): array|object|int|string|bool
    {
        $isUpload = Upload::local()->store($request, Bucket::VEHICLE, $request->input('image_id'));
        $instance->update(array_merge_recursive($request->only('user_id', 'category_id', 'merchant_id', 'brand_id', 'edition_id', 'condition_id', 'transmission_id', 'engines', 'fuel_id', 'skeleton_id', 'mileages', 'grade_id', 'registration', 'manufacture', 'purchase_price', 'fixed_price', 'additional_price', 'price', 'is_approved', 'publish_at', 'is_feat', 'status', 'color_id', 'carmodel_id', 'code', 'available_id', 'registration_id', 'prioty', 'video', 'engine_number', 'chassis_number', 'negotiable'), [
            'slug' => $this->makeSlugString($request->input('title')) . uniqid()
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }
}
