<?php

namespace App\Services\Uploads\Adapters;

use App\Enums\Disk;
use App\Services\Uploads\Clusters\CloudStorage;
use App\Services\Uploads\Clusters\LocalStorage;
use App\Services\Uploads\Interfaces\UploadInterface;

abstract class UploadAdapter implements UploadInterface
{
    /**
     * Create a new upload instance
     * @return void
     */
    final public function __construct()
    {
        // TODO: Your Code Here...
    }

    /**
     * Define the both disk storage
     * @param  Disk|null                 $disk
     * @return CloudStorage|LocalStorage
     */
    abstract public function disks(?Disk $disk = Disk::LOCAL): CloudStorage|LocalStorage;
}
