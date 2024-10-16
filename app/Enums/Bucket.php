<?php

namespace App\Enums;

enum Bucket
{
    case BRAND;
    case VEHICLE;
    case SLIDER;
    case GALLERY;
    case PROPERTY;
    case ACCESSORY;
    case MERCHANT;
    case RESIDENCE;

    public function toString(): string
    {
        return match ($this) {
            self::BRAND     => 'brands',
            self::VEHICLE   => 'vehicles',
            self::SLIDER    => 'sliders',
            self::GALLERY   => 'galleries',
            self::PROPERTY  => 'properties',
            self::ACCESSORY => 'accessories',
            self::MERCHANT => 'merchants',
            self::RESIDENCE => 'residences'
        };
    }
}
