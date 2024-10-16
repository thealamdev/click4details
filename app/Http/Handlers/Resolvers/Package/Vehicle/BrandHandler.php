<?php

namespace App\Http\Handlers\Resolvers\Package\Vehicle;

use App\Enums\Bucket;
use App\Facades\Upload;
use App\Http\Handlers\Adapters\HandlerAdapter;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BrandHandler extends HandlerAdapter
{
    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array|object|int|string|bool
    {
        $isUpload = Upload::local()->store($request, Bucket::BRAND);
        $instance = Brand::query()->create(array_merge_recursive($request->only('status'), [
            'slug' => $this->makeSlugString($request->input('title'))
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
        $process = $instance instanceof Model ? $instance : Brand::query()->findOrFail($instance->brand);
        if (isset($process->image) && !empty($process->image)) {
            $process->image->recycle();
            $process->image()?->delete();
        }
        collect($process->translate)->map(fn ($i) => $i->delete());
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
        $isUpload = Upload::local()->store($request, Bucket::BRAND, $request->input('image_id'));
        $instance->update(array_merge_recursive($request->only('status'), [
            'slug' => $this->makeSlugString($request->input('title'))
        ]));
        $this->withStoreLocal($instance, $request->input('title'))->withStoreImage($instance, $isUpload);
        return $instance;
    }
}
