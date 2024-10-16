<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum Share
{
    case FACEBOOK;
    case LINKEDIN;
    case TWITTER;
    case WHATSAPP;
    case TELEGRAM;

    public function toString(): string
    {
        return match ($this) {
            self::FACEBOOK  => 'Facebook',
            self::LINKEDIN  => 'LinkedIn',
            self::TWITTER   => 'Twitter',
            self::WHATSAPP  => 'Whatsapp',
            self::TELEGRAM  => 'Telegram',
        };
    }

    public function toShared(string $title): string
    {
        $response = match ($this) {
            self::FACEBOOK  => 'https://www.facebook.com/sharer/sharer.php?u=',
            self::LINKEDIN  => 'https://www.linkedin.com/sharing/share-offsite?mini=true&url=',
            self::TWITTER   => sprintf('https://twitter.com/intent/tweet?text=%s&url=', $title),
            self::WHATSAPP  => 'https://wa.me/?text=',
            self::TELEGRAM  => sprintf('https://telegram.me/share/url?text=%s&url=', $title),
        };
        return sprintf('%s%s/%s', $response, config('app.url'), Str::of($title)->replace(' ', '-')->lower()->toString());
    }

    public function toBrands(): string
    {
        return match ($this) {
            self::FACEBOOK  => 'fa-brands fa-facebook',
            self::LINKEDIN  => 'fa-brands fa-linkedin-in',
            self::TWITTER   => 'fa-brands fa-twitter',
            self::WHATSAPP  => 'fa-brands fa-whatsapp',
            self::TELEGRAM  => 'fa-brands fa-telegram',
        };
    }

    public function toColors(): string
    {
        return match ($this) {
            self::FACEBOOK  => '2377F3',
            self::LINKEDIN  => '1C77B5',
            self::TWITTER   => '29A1F2',
            self::WHATSAPP  => '29A1Fc',
            self::TELEGRAM  => '29A1Fx',
        };
    }

    public static function iterator(?bool $instance = false): array
    {
        return collect(self::cases())->map(fn ($i) => $instance === true ? $i : $i->toString())->toArray();
    }
}
