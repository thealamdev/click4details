<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

if (!function_exists('parseDirExtractor')) {
    /**
     * Get all files from a directory
     * @param array|null  $skipFiles
     * @param string|null $directory
     * @param string|null $extension
     *
     * @return array|object
     */
    function parseDirExtractor(?array $skipFiles = [], ?string $directory = null, ?string $extension = null): array|object
    {
        $resource = File::allFiles(base_path($directory));
        $response = collect($resource)->map(fn ($i) => str_replace($extension, '', $i->getFileName()))->toArray();
        if (isset($skipFiles) && count($skipFiles) > 0) {
            Arr::forget($response, array_map(fn ($x) => array_search($x, $response), $skipFiles));
        }
        return array_values($response);
    }
}

if (!function_exists('jsonFileExtractor')) {
    /**
     * Get the json file contexts
     * @param  string            $fileName
     * @param  Closure|null      $closure
     * @param  bool|null         $associative
     * @return array|object|null
     */
    function jsonFileExtractor(string $fileName, ?Closure $closure = null, ?bool $associative = true): array|object|null
    {
        $resource = json_decode(File::get($fileName), $associative);
        if (isset($closure) && is_callable($closure)) {
            return call_user_func($closure, $resource);
        }
        return $resource;
    }
}

if (!function_exists('routeLinkResource')) {
    /**
     * Get the routes list
     * @param  string|null  $path
     * @return array|object
     */
    function routeLinkResource(?string $path = 'admin'): array|object
    {
        $values = [];
        $source = Route::getRoutes();
        foreach ($source as $each) {
            if (Str::of($each->getName())->startsWith(sprintf('%s.', $path))) {
                $parse['call'] = Str::of($each->getName())->replace(sprintf('%s.', $path), '')->title()->toString();
                $parse['name'] = $each->getName();
                $parse['path'] = $each->uri;
                $parse['type'] = current($each->methods);
                $values[] = (object) $parse;
            }
        }
        return $values;
    }
}
