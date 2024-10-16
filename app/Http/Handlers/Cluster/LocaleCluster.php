<?php

namespace App\Http\Handlers\Cluster;

use App\Models\Translate;
use Illuminate\Database\Eloquent\Model;

trait LocaleCluster
{
    /**
     * Handle the incoming translate create or update request
     * @param  Model        $model
     * @param  array|object $locale
     * @return $this
     */
    public function withStoreLocal(Model $model, array|object $locale): static
    {
        $resolver = ['translate_type' => get_class($model), 'translate_id' => $model->getKey()];
        foreach ($locale as $lang => $each) {
            $source = array_merge_recursive($resolver, ['local' => $lang]);
            $values = array_merge_recursive($source, ['title' => trim($each, "'")]);
            Translate::query()->updateOrCreate($source, $values);
        }
        return $this;
    }

    /**
     * Handle the incoming translate delete request
     * @param  Model     $model
     * @param  bool|null $forceDelete
     * @return $this
     */
    public function withTrashLocal(Model $model, ?bool $forceDelete = false): static
    {
        $resolver = ['translate_type' => get_class($model), 'translate_id' => $model->getKey()];
        $toDelete = Translate::query()->where($resolver)->first();
        if ($forceDelete === true) {
            $toDelete->forceDelete();
        }
        $toDelete->delete();
        return $this;
    }
}
