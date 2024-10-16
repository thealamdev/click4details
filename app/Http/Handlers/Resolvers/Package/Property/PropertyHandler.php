<?php

namespace App\Http\Handlers\Resolvers\Package\Property;

use App\Enums\Bucket;
use App\Facades\Upload;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Handlers\Adapters\HandlerAdapter;
use App\Models\Property;

class PropertyHandler extends HandlerAdapter
{
    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array|object|int|string|bool
    {
        $isUpload = Upload::local()->store($request, Bucket::PROPERTY);
        $instance = Property::query()->create(array_merge_recursive($request->only('category_id', 'merchant_id','priceunit_id', 'sizeunit_id', 'type_id','land_size','address','negotiable','priority','code','price','is_approved','publish_at','status','mobile'), [
            'slug' => $this->makeSlugString($request->input('title')).uniqid()
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }


    public function erase(Model|Request $instance, ?bool $isForceDelete = false): array|object|int|string|bool
    {
        $process = $instance instanceof Model ? $instance : Property::query()->findOrFail($instance->property);
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
        $isUpload = Upload::local()->store($request, Bucket::PROPERTY, $request->input('image_id'));
        $instance->update(array_merge_recursive($request->only('category_id', 'merchant_id','priceunit_id', 'sizeunit_id', 'type_id','land_size','address','negotiable','priority','code','price','is_approved','publish_at','status','mobile'), [
            'slug' => $this->makeSlugString($request->input('title'))
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }


     

    
}
