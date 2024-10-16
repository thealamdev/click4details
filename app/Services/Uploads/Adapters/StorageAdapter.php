<?php

namespace App\Services\Uploads\Adapters;

use App\Enums\Disk;
use App\Models\Image;
use App\Services\Uploads\Interfaces\StorageInterface;

abstract class StorageAdapter extends ConcreteCluster implements StorageInterface
{
    /**
     * Define the full image path
     * @var string|null
     */
    protected ?string $parse = null;

    /**
     * Define the deletable file
     * @var string|null
     */
    protected ?string $purge = null;

    /**
     * Existing image object handler
     * @var array|object|null
     */
    protected array|object|null $image = null;

    /**
     * Define the disk space handler
     * @var Disk
     */
    protected Disk $disk;

    /**
     * Create a new object instance
     * @param  Disk  $disk
     * @return $this
     */
    public function instance(Disk $disk): static
    {
        $this->disk = $disk;
        return $this;
    }

    /**
     * Get the resource if exists on ID
     * @param  int|string|null $id
     * @return $this
     */
    protected function isExists(int|string|null $id): static
    {
        if (isset($id)) {
            $this->image = Image::query()->select(['disk', 'name', 'path', 'mime', 'size'])->where('id', '=', $id)->first();
            $this->purge = sprintf('%s/%s', $this->image?->path, $this->image?->name);
        }
        return $this;
    }

    /**
     * Response the uploaded file data
     * @return array
     */
    protected function response(): array
    {
        return [
            'disk' => $this->getFileDisk() ?? $this->image?->disk,
            'path' => $this->getFilePath() ?? $this->image?->path,
            'name' => $this->getFileName() ?? $this->image?->name,
            'mime' => $this->getFileMime() ?? $this->image?->mime,
            'size' => $this->getFileSize() ?? $this->image?->size
        ];
    }
}
