<?php

namespace App\Services\Utils;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

trait TemporarySignedRoute
{
    /**
     * Get temporary signed route link
     * @param  int|string  $id
     * @param  string      $email
     * @param  string|null $route
     * @param  string|null $key
     * @return string
     */
    public static function buildURL(int|string $id, string $email, ?string $route = 'verification.verify', ?string $key = 'auth.verification.expire'): string
    {
        return URL::temporarySignedRoute($route, Carbon::now()->addMinutes(Config::get($key, 60)), [
            'id'    => $id,
            'hash'  => sha1($email),
        ]);
    }
}
