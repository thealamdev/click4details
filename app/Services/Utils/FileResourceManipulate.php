<?php

namespace App\Services\Utils;

use App\Enums\Disk;
use App\Facades\Upload;

trait FileResourceManipulate
{
    /**
     * Get the upload image file path
     * @return string
     * @noinspection PhpUndefinedFieldInspection
     */
    private function hasPath(): string
    {
        return sprintf('%s/%s', $this->path, $this->name);
    }

    /**
     * Get the upload image disk driver
     * @return Disk|null
     * @noinspection PhpUndefinedFieldInspection
     */
    private function hasDisk(): ?Disk
    {
        return Disk::toSearch($this->disk);
    }

    /**
     * Preview the uploaded image
     * @return string|void|null
     * @noinspection PhpUndefinedFieldInspection
     */
    public function preview()
    {
        if (is_object($this) && !empty($this)) {
            return Upload::disks($this->hasDisk())->watch($this->hasPath());
        }
    }

    /**
     * Deleted the uploaded image
     * @return string|int|bool|void
     * @noinspection PhpUndefinedFieldInspection
     */
    public function recycle()
    {
        if (is_object($this) && !empty($this)) {
            return Upload::disks($this->hasDisk())->trash($this->hasPath());
        }
    }
}
