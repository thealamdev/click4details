<?php

namespace App\Http\Handlers\Resolvers\Package\Accessory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Enums\Bucket;
use App\Facades\Upload;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Handlers\Adapters\HandlerAdapter;
use App\Models\Accessory;


class AccessoryHandler extends HandlerAdapter
{
    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array|object|int|string|bool
    {
        $isUpload = Upload::local()->store($request, Bucket::ACCESSORY);
        $instance = Accessory::query()->create(array_merge_recursive($request->only('category_id','purchase_from','purchase_price','user_id','accessory_brand_id', 'merchant_id', 'quantity', 'priority', 'code', 'price', 'is_approved', 'publish_at', 'status'), [
            'slug' => $this->makeSlugString($request->input('title')) . uniqid()
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }


    // public function erase(Model|Request $instance, ?bool $isForceDelete = false): array|object|int|string|bool
    // {
    //     $process = $instance instanceof Model ? $instance : Accessory::query()->findOrFail($instance->accessory);
    //     if (isset($process->image) && !empty($process->image)) {
    //         $process->image->recycle();
    //         $process->image()?->delete();
    //     }
    //     if (isset($process->gallery) && !empty($process->gallery)) {
    //         foreach ($process->gallery as $gallery) {
    //             $gallery->recycle();
    //             $gallery->delete();
    //         }
    //     }
    //     collect($process->translate)->map(fn ($i) => $i->delete());
    //     collect($process->description)->map(fn ($i) => $i->delete());
    //     return $process->delete();
    // }


    public function erase(Model|Request $instance, ?bool $isForceDelete = false): array|object|int|string|bool
    {
        try {
            $process = $instance instanceof Model ? $instance : Accessory::query()->findOrFail($instance->accessory);
    
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
        } catch (ModelNotFoundException $e) {
            // Handle the case when the record is not found
            return 'Record not found'; // or any other appropriate response
        }
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
        $isUpload = Upload::local()->store($request, Bucket::ACCESSORY, $request->input('image_id'));
        $instance->update(array_merge_recursive($request->only('category_id','merchant_id','quantity','code','price','is_approved','publish_at','status'), [
            'slug' => $this->makeSlugString($request->input('title'))
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }

 
}
