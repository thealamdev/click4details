<?php

namespace App\Http\Handlers\Adapters;

use App\Enums\Locale;
use App\Http\Handlers\Cluster\ImageCluster;
use App\Http\Handlers\Cluster\LocaleCluster;
use App\Http\Handlers\Interfaces\HandlerInterface;
use Illuminate\Support\Str;

abstract class HandlerAdapter implements HandlerInterface
{
    use LocaleCluster;
    use ImageCluster;

    /**
     * Create a new handler instance
     * @return void
     */
    public function __construct()
    {
        // TODO: Skip Code Here...
    }

    /**
     * Process the slug from request array
     * @param  array  $title
     * @return string
     */
    protected function makeSlugString(array $title): string
    {
        return Str::of($title[Locale::ENGLISH->toString()])->slug()->toString();
    }

    /**
     * Process the morph relations array
     * @param  string $title
     * @param  object $model
     * @return array
     */
    protected function morphsRelation(string $title, object $model): array
    {
        $name = sprintf('%s_type', $title);
        $type = sprintf('%s_id', $title);
        return [$name => get_class($model), $type => $model->getKey()];
    }
}
