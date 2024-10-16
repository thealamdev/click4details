<?php

namespace App\Enums;

enum Locale
{
    case ENGLISH;
    case BENGALI;

    public function toString(?bool $abbr = true): string
    {
        return match ($this) {
            self::ENGLISH => $abbr === false ? 'English' : 'en',
            self::BENGALI => $abbr === false ? 'Bengali' : 'bn',
        };
    }

    public static function toSearch(string $search): Locale
    {
        return match ($search) {
            'en' => self::ENGLISH,
            'bn' => self::BENGALI,
        };
    }

    public static function iterator(?bool $abbr = true): array
    {
        return collect(self::cases())->map(fn ($i) => $i->toString($abbr))->toArray();
    }
}
