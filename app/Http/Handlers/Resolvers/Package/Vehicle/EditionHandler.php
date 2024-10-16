<?php

namespace App\Http\Handlers\Resolvers\Package\Vehicle;

use App\Http\Handlers\Adapters\HandlerAdapter;
use App\Models\Edition;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EditionHandler extends HandlerAdapter
{
    /**
     * Handle the incoming create request
     * @param  Request                      $request
     * @return array|object|int|string|bool
     */
    public function store(Request $request): array|object|int|string|bool
    {
        $instance = Edition::query()->create(array_merge_recursive($request->only('status'), [
            'slug' => $this->makeSlugString($request->input('title'))
        ]));
        $this->withStoreLocal($instance, $request->input('title'));
        return $instance;
    }

    /**
     * Handle the incoming delete request
     * @param  Model|Request                $instance
     * @param  bool|null                    $isForceDelete
     * @return array|object|int|string|bool
     * @noinspection PhpUndefinedFieldInspection
     */
    public function erase(Model|Request $instance, ?bool $isForceDelete = false): array|object|int|string|bool
    {
        $process = $instance instanceof Model ? $instance : Edition::query()->findOrFail($instance->edition);
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
        $instance->update(array_merge_recursive($request->only('status'), [
            'slug' => $this->makeSlugString($request->input('title'))
        ]));
        $this->withStoreLocal($instance, $request->input('title'));
        return $instance;
    }
}
