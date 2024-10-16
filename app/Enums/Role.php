<?php

namespace App\Enums;

enum Role
{
    case ADMIN;
    case MODERATOR;
    case EDITOR;
    case AUTHOR;
    case CONTRIBUTOR;
    case PUBLISHER;
    case EMPLOYEE;
    case MANAGER;

    public function toString(): string
    {
        return match ($this) {
            self::ADMIN         => 'Admin',
            self::MODERATOR     => 'Moderator',
            self::EDITOR        => 'Editor',
            self::AUTHOR        => 'Author',
            self::CONTRIBUTOR   => 'Contributor',
            self::PUBLISHER     => 'Publisher',
            self::EMPLOYEE      => 'Employee',
            self::MANAGER       => 'Manager',
        };
    }

    public static function iterator(): array
    {
        return collect(self::cases())->map(fn ($i) => $i->toString())->toArray();
    }
}
