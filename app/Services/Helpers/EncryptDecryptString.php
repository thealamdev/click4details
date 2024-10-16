<?php

use Illuminate\Support\Facades\Crypt;

if (!function_exists('encodeString')) {
    /**
     * Encode array to string
     * @param  array  $array
     * @return string
     */
    function encodeString(array $array): string
    {
        return base64_encode(json_encode($array));
    }
}

if (!function_exists('decodeString')) {
    /**
     * Encode array to string
     * @param  string       $encode
     * @param  bool|null    $array  $array
     * @return array|object
     */
    function decodeString(string $encode, ?bool $array = false): array|object
    {
        return json_decode(base64_decode($encode), $array);
    }
}

if (!function_exists('encryptString')) {
    /**
     * Encrypt the incoming string
     * @param  int|string $data
     * @return string
     */
    function encryptString(int|string $data): string
    {
        return Crypt::encryptString($data);
    }
}

if (!function_exists('decryptString')) {
    /**
     * Decrypt the encrypted string
     * @param  string $encoded
     * @return string
     */
    function decryptString(string $encoded): string
    {
        return Crypt::decryptString($encoded);
    }
}
