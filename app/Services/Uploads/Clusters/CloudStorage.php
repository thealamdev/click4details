<?php

namespace App\Services\Uploads\Clusters;

use App\Enums\Bucket;
use App\Services\Uploads\Adapters\StorageAdapter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CloudStorage extends StorageAdapter
{
    /**
     * Handle the incoming trash request
     * @param  string|null     $fileName
     * @return int|string|bool
     */
    public function trash(?string $fileName = null): int|string|bool
    {
        if ((!is_null($fileName) && $fileName !== '/') && Storage::disk(strtolower($this->disk->toString()))->exists($fileName)) {
            Storage::disk(strtolower($this->disk->toString()))->delete($fileName);
            return true;
        }
        return false;
    }

    /**
     * Handle the incoming store request
     * @param  FormRequest|Request      $request
     * @param  Bucket                   $bucket
     * @param  string|null              $existed
     * @param  string|null              $fileName
     * @param  string|null              $access
     * @return array|object|string|null
     */
    public function store(FormRequest|Request $request, Bucket $bucket, ?string $existed = null, ?string $fileName = 'image', ?string $access = 'public'): array|object|string|null
    {
        $this->isExists($existed);
        if ($request->file() && $request->hasFile($fileName)) {
            $file = $request->file($fileName);
            $this->setFileDisk($this->disk->toString())->setFilePath($bucket->toString())->setFileName($file->hashName())->setFileSize($file->getSize())->setFileMime($file->getMimeType())->trash($this->purge);
            Storage::disk(strtolower($this->disk->toString()))->put($bucket->toString(), $file, $access);
        }
        return $this->response();
    }

    /**
     * Handle the incoming image request
     * @param  string|null $fileName
     * @param  string|null $fallBack
     * @return string|null
     */
    public function watch(?string $fileName = null, ?string $fallBack = self::FALLBACK_IMAGE): ?string
    {
        if ((!is_null($fileName) && $fileName !== '/') && Storage::disk(strtolower($this->disk->toString()))->exists($fileName)) {
            return $this->parse . '/' . $fileName;
        }
        return $fallBack;
    }
}
