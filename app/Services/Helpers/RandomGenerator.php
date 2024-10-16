<?php

use Illuminate\Support\Str;

if (!function_exists('randomOtpCode')) {
    /**
     * Get a new OTP code
     * @param  int|null $length
     * @return string
     */
    function randomOtpCode(?int $length = 6): string
    {
        $random = rand(Str::padRight(1, $length, 0), Str::padRight(9, $length, 9));
        return Str::padBoth($random, $length, 0);
    }
}

if (!function_exists('randomInvoiceNo')) {
    /**
     * Get a new invoice no
     * @param  int|string $number
     * @return string
     */
    function randomInvoiceNo(int|string $number): string
    {
        $random = Str::padLeft($number, 6, 0);
        return strtoupper(sprintf('PEI-%s-%s', now()->format('ymd'), $random));
    }
}

if (!function_exists('randomProductSKU')) {
    /**
     * Get a new product SKU or UUID
     * @param  int|string ...$number
     * @return string
     */
    function randomProductSKU(int|string ...$number): string
    {
        $collect = collect($number)->map(fn ($x) => Str::padLeft($x, 3, 0))->implode('');
        return strtoupper(sprintf('PEP-%s', $collect));
    }
}

if (!function_exists('randomReferralID')) {
    /**
     * Get the personal referral ID
     * @param  int|null $length
     * @return string
     */
    function randomReferralID(?int $length = 6): string
    {
        $parser = sprintf('%s%s%s', strtolower('abcdefghijklmnopqrstuvwxyz'), '0123456789', 'abcdefghijklmnopqrstuvwxyz');
        $string = '';
        for ($i = 0; $i <= $length; $i++) {
            $resolve = rand(0, strlen($parser) - 1);
            $string .= $parser[$resolve];
        }
        return strtoupper($string);
    }
}

if (!function_exists('randomPassword')) {
    /**
     * Get a new secure passphrase
     * @param  int|null $length
     * @return string
     */
    function randomPassword(?int $length = 12): string
    {
        $cipher = sprintf('%s%s%s%s', '0123456789', strtoupper('abcdefghijklmnopqrstuvwxyz'), '~!@#$%^&*(){}[]:;<>?+-*', strtolower('abcdefghijklmnopqrstuvwxyz'));
        $strMax = strlen($cipher) - 1;
        $string = [];
        for ($i = 0; $i <= $length; $i++) {
            $randString = rand(0, $strMax);
            $string[$i] = $cipher[$randString];
        }
        return implode('', $string);
    }
}
