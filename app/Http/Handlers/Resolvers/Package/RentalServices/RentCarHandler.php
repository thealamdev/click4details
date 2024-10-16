<?php

namespace App\Http\Handlers\Resolvers\Package\RentalServices;

use App\Enums\Bucket;
use App\Models\Brand;
use App\Facades\Upload;
use App\Models\RentCar;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Handlers\Adapters\HandlerAdapter;

class RentCarHandler extends HandlerAdapter
{
    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array|object|int|string|bool
    {
        $isUpload = Upload::local()->store($request, Bucket::VEHICLE);
        $instance = RentCar::query()->create(array_merge_recursive($request->only(
            'merchant_id',
            'brand_id',
            'color_id',
            'carmodel_id',
            'vehicle_status',
            'ac',
            'seat',
            'vehicle_type',
            'daily_charge_inside_dhaka',
            'daily_max_visit_inside',
            'extra_charge_perkm_daily_inside',
            'daily_charge_outside_dhaka',
            'daily_max_visit_outside',
            'extra_charge_perkm_daily_outside',
            'monthly_charge_inside_dhaka',
            'monthly_max_visit_inside',
            'extra_charge_perkm_monthly_inside',
            'monthly_charge_outside_dhaka',
            'monthly_max_visit_outside',
            'extra_charge_perkm_monthly_outside',
            'mileages',
            'status'
        ), [
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
        $instance->update(array_merge_recursive($request->only(
            'merchant_id',
            'brand_id',
            'color_id',
            'carmodel_id',
            'vehicle_status',
            'ac',
            'seat',
            'vehicle_type',
            'daily_charge_inside_dhaka',
            'daily_max_visit_inside',
            'extra_charge_perkm_daily_inside',
            'daily_charge_outside_dhaka',
            'daily_max_visit_outside',
            'extra_charge_perkm_daily_outside',
            'monthly_charge_inside_dhaka',
            'monthly_max_visit_inside',
            'extra_charge_perkm_monthly_inside',
            'monthly_charge_outside_dhaka',
            'monthly_max_visit_outside',
            'extra_charge_perkm_monthly_outside',
            'mileages',
            'status'
        ), [
            'slug' => $this->makeSlugString($request->input('title')) . uniqid()
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }
}
