<?php

namespace App\Facades;

use App\Enums\Disk;
use App\Services\Uploads\Clusters\CloudStorage;
use App\Services\Uploads\Clusters\LocalStorage;
use App\Services\Uploads\UploadManager;
use Illuminate\Support\Facades\Facade;

/**
 * @method static LocalStorage              local()
 * @method static CloudStorage              cloud(?Disk $disk = Disk::FTP)
 * @method static CloudStorage|LocalStorage disks(?Disk $disk = Disk::LOCAL)
 */
class Upload extends Facade
{
    /**
     * Create a new static facade instance
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return UploadManager::class;
    }
}
