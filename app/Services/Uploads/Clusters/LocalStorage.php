<?php

namespace App\Services\Uploads\Clusters;

use App\Enums\Disk;
use App\Enums\Bucket;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\ImageDimention;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\Uploads\Adapters\StorageAdapter;

class LocalStorage extends StorageAdapter
{
    /**
     * public property $image_dimention
     */
    public $image_dimention = null;

    /**
     * Handle the incoming trash request
     * @param  string|null     $fileName
     * @return int|string|bool
     */
    public function trash(?string $fileName = null): int|string|bool
    {
        $filePath = 'storage/' . $fileName;
        if ((!is_null($fileName) && $fileName !== '/') && file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
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
        $this->image_dimention = ImageDimention::query()->latest()->first();
        $this->isExists($existed);
        if ($request->file() && $request->hasFile($fileName)) {
            $file = $request->file($fileName);
            $this->setFileDisk(Disk::LOCAL->toString())->setFilePath($bucket->toString())->setFileName($file->hashName())->setFileSize($file->getSize())->setFileMime($file->getMimeType())->trash($this->purge);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->file('image'));
            $upload = $image->resize($this->image_dimention?->width, $this->image_dimention?->height);
            $upload->toJpeg(80)->save(storage_path("app/public/{$bucket->toString()}/" . $this->getFileName()));
        }
        return $this->response();
    }

    public function storeProfile(FormRequest|Request $request, Bucket $bucket, ?string $existed = null, ?string $fileName = 'image', ?string $access = 'public'): array|object|string|null
    {
        $this->image_dimention = ImageDimention::query()->latest()->first();
        $this->isExists($existed);
        if ($request->file() && $request->hasFile($fileName)) {
            $file = $request->file($fileName);
            $this->setFileDisk(Disk::LOCAL->toString())->setFilePath($bucket->toString())->setFileName($file->hashName())->setFileSize($file->getSize())->setFileMime($file->getMimeType())->trash($this->purge);
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($request->file('image'));
            $upload = $image->resize(300, 300);
            $upload->toJpeg(80)->save(storage_path("app/public/{$bucket->toString()}/" . $this->getFileName()));
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
        $filePath = 'storage/' . $fileName;
        if ((!is_null($fileName) && $fileName !== '/') && file_exists($filePath) && is_file($filePath)) {
            return asset($filePath);
        }
        return $fallBack;
    }

    /**
     * method for uplodding and store multiple image in database and folder.
     * @param $file
     */
    public function storeImage($file)
    {
        $this->image_dimention = ImageDimention::query()->latest()->first();
        $ex = $file->getClientOriginalExtension();
        $fileName = uniqid() . '.' . $ex;
        $url = asset('storage/galleries' . $fileName);

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($file);
        $upload = $image->resize($this->image_dimention?->width, $this->image_dimention?->height);
        $upload->toJpeg(80)->save(storage_path("app/public/galleries/" . $fileName));

        $filePath = 'galleries';
        $mime = 'image/' . $ex;
        $size = '1 mb';

        return [
            'url' => $url,
            'filename' => $fileName,
            'name' => $fileName,
            'path' => $filePath,
            'mime' => $mime,
            'size' => $size,
        ];
    }
}
