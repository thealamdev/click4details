<?php

namespace App\Services\Uploads\Interfaces;

use App\Enums\Bucket;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

interface StorageInterface
{
    /**
     * Define the fallback image path
     * @var string
     */
    public const FALLBACK_IMAGE = "https://placehold.co/600x400";

    /**
     * Remove a file from the storage
     * @param  string|null     $fileName
     * @return int|string|bool
     */
    public function trash(?string $fileName = null): int|string|bool;

    /**
     * Uploads a file to the storage
     * @param  FormRequest|Request      $request
     * @param  Bucket                   $bucket
     * @param  null|string              $existed
     * @param  null|string              $fileName
     * @param  null|string              $access
     * @return array|object|string|null
     */
    public function store(FormRequest|Request $request, Bucket $bucket, ?string $existed = null, ?string $fileName = 'image', ?string $access = 'public'): array|object|string|null;

    /**
     * Preview a file form the storage
     * @param  string|null $fileName
     * @param  null|string $fallBack
     * @return string|null
     */
    public function watch(?string $fileName = null, ?string $fallBack = self::FALLBACK_IMAGE): ?string;
}
