<?php

namespace App\Enums;

enum Disk
{
    case S3;
    case GOOGLE;
    case DROPBOX;
    case FTP;
    case SFTP;
    case LOCAL;

    public function toString(): string
    {
        return match ($this) {
            self::S3        => 'S3',
            self::GOOGLE    => 'G-Drive',
            self::DROPBOX   => 'Dropbox',
            self::FTP       => 'FTP',
            self::SFTP      => 'SFTP',
            self::LOCAL     => 'Local'
        };
    }

    public static function toSearch(string $disk): Disk
    {
        return match ($disk) {
            'S3'        => self::S3,
            'G-Drive'   => self::GOOGLE,
            'Dropbox'   => self::DROPBOX,
            'FTP'       => self::FTP,
            'SFTP'      => self::SFTP,
            'Local'     => self::LOCAL,
        };
    }

    public static function iterator(): array
    {
        return collect(self::cases())->map(fn ($i) => $i->toString())->toArray();
    }
}
