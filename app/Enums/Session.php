<?php

namespace App\Enums;

enum Session
{
    case COLOR_THEME;
    case TRANSLATION;

    public function toString(): string
    {
        return match ($this) {
            self::COLOR_THEME => 'colorSchema',
            self::TRANSLATION => 'translation',
        };
    }

    public static function iterator(): array
    {
        return collect(self::cases())->map(fn ($i) => $i->toString())->toArray();
    }
}
