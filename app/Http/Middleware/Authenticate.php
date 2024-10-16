<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated
     * @param  Request     $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        $match = $request->routeIs('admin.*') ? 'admin' : ($request->routeIs('merchant.*') ? 'merchant' : ($request->routeIs('customer-care.*') ? 'customer-care' : null));
        return $request->expectsJson() ? null : match ($match) {
            'admin'     => route('admin.login.create'),
            'booster'   => route('booster.login.create'),
            'customer-care' => route('customer-care.login.create'),
            default     => route('client.login.create')
        };
    }
}
