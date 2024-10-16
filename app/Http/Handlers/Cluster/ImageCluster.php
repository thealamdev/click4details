<?php

namespace App\Http\Handlers\Cluster;

use App\Enums\Disk;
use App\Facades\Upload;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

trait ImageCluster
{
    /**
     * Handle the incoming image create or update request
     * @param  Model        $model
     * @param  array|object $upload
     * @return $this
     */
    public function withStoreImage(Model $model, array|object $upload): static
    {
        $resolver = $this->morphsRelation('image', $model);
        Image::query()->updateOrCreate($resolver, array_merge_recursive($resolver, $upload));
        return $this;
    }

    /**
     * Handle the incoming image create or update request
     * @param  Model     $model
     * @param  bool|null $forceDelete
     * @return $this
     */
    public function withTrashImage(Model $model, ?bool $forceDelete = false): static
    {
        $resolver = $this->morphsRelation('image', $model);
        $toDelete = Image::query()->where($resolver)->first();
        Upload::disks(Disk::toSearch($toDelete->disk))->trash(sprintf('%s/%s', $toDelete->path, $toDelete->name));
        if ($forceDelete === true) {
            $toDelete->forceDelete();
        }
        $toDelete->delete();
        return $this;
    }
}
