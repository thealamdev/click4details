<?php

namespace App\Enums;

enum HttpCode
{
    case OK;
    case CREATED;
    case ACCEPTED;
    case NO_CONTENT;
    case NOT_MODIFIED;
    case BAD_REQUEST;
    case UNAUTHORIZED;
    case FORBIDDEN;
    case NOT_FOUND;
    case METHOD_NOT_ALLOWED;
    case NOT_ACCEPTABLE;
    case INTERNAL_SERVER_ERROR;
    case UNPROCESSABLE_CONTENT;

    public function toString(): string
    {
        return match ($this) {
            self::OK                    => '200',
            self::CREATED               => '201',
            self::ACCEPTED              => '202',
            self::NO_CONTENT            => '204',
            self::NOT_MODIFIED          => '304',
            self::BAD_REQUEST           => '400',
            self::UNAUTHORIZED          => '401',
            self::FORBIDDEN             => '403',
            self::NOT_FOUND             => '404',
            self::METHOD_NOT_ALLOWED    => '405',
            self::NOT_ACCEPTABLE        => '406',
            self::UNPROCESSABLE_CONTENT => '422',
            self::INTERNAL_SERVER_ERROR => '500',
        };
    }
}
