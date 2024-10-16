<?php

namespace App\Services\Uploads;

use App\Enums\Disk;
use App\Services\Uploads\Adapters\UploadAdapter;
use App\Services\Uploads\Clusters\CloudStorage;
use App\Services\Uploads\Clusters\LocalStorage;

class UploadManager extends UploadAdapter
{
    /**
     * Get the local storage instance
     * @return LocalStorage
     */
    public function local(): LocalStorage
    {
        return new LocalStorage();
    }

    /**
     * Get the cloud storage instance
     * @param  Disk|null    $disk
     * @return CloudStorage
     */
    public function cloud(?Disk $disk = Disk::FTP): CloudStorage
    {
        return (new CloudStorage())->instance($disk);
    }

    /**
     * @param  Disk|null                 $disk
     * @return CloudStorage|LocalStorage
     */
    public function disks(?Disk $disk = Disk::LOCAL): CloudStorage|LocalStorage
    {
        return match ($disk) {
            Disk::FTP, Disk::GOOGLE, Disk::S3, Disk::SFTP => (new CloudStorage())->instance($disk),
            default => new LocalStorage()
        };
    }
}
