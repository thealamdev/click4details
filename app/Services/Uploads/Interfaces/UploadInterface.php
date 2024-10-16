<?php

namespace App\Services\Uploads\Interfaces;

use App\Enums\Disk;
use App\Services\Uploads\Clusters\CloudStorage;
use App\Services\Uploads\Clusters\LocalStorage;

interface UploadInterface
{
    /**
     * Handle the cloud storage
     * @param  Disk|null    $disk
     * @return CloudStorage
     */
    public function cloud(?Disk $disk = Disk::FTP): CloudStorage;

    /**
     * Handle the local storage
     * @return LocalStorage
     */
    public function local(): LocalStorage;
}
