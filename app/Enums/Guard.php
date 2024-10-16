<?php

namespace App\Enums;

enum Guard
{
    case ADMIN;
    case MERCHANT;
    case CLIENT;
    case CUSTOMERCARE;

    public function toString(): string
    {
        return match ($this) {
            self::ADMIN     => 'web',
            self::MERCHANT  => 'merchant',
            self::CLIENT    => 'client',
            self::CUSTOMERCARE => 'customercare'
        };
    }

    public function toBroker(): string
    {
        return match ($this) {
            self::ADMIN     => 'users',
            self::MERCHANT  => 'merchants',
            self::CLIENT    => 'clients',
            self::CUSTOMERCARE => 'customercare'
        };
    }
}
