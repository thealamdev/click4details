<?php

namespace App\Http\Handlers\Resolvers\Package\Residence;

use App\Enums\Bucket;
use App\Facades\Upload;
use App\Models\Residence;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Handlers\Adapters\HandlerAdapter;

class ResidenceHandler extends HandlerAdapter
{
    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array|object|int|string|bool
    {
        $isUpload = Upload::local()->store($request, Bucket::RESIDENCE);
        $instance = Residence::query()->create(array_merge_recursive($request->only(
            'merchant_id',
            'completion_status_id',
            'furnished_status_id',
            'apartment_complex_id',
            'price',
            'unit_price',
            'negotiable',
            'address',
            'bedrooms',
            'bathrooms',
            'facing',
            'size',
            'land_share_apartments',
            'mobile',
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
     */
    public function erase(Model|Request $instance, ?bool $isForceDelete = false): array|object|int|string|bool
    {
        $process = $instance instanceof Model ? $instance : Residence::query()->findOrFail($instance->residence);
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
        $isUpload = Upload::local()->store($request, Bucket::RESIDENCE, $request->input('image_id'));
        $instance->update(array_merge_recursive($request->only(
            'merchant_id',
            'completion_status_id',
            'furnished_status_id',
            'apartment_complex_id',
            'price',
            'unit_price',
            'negotiable',
            'address',
            'bedrooms',
            'bathrooms',
            'facing',
            'size',
            'land_share_apartments',
            'mobile', 
            'status'
        ), [
            'slug' => $this->makeSlugString($request->input('title')) . uniqid()
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }
}
