<?php

const BENGALI = [
    'numbers' => ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০'],
    'elapsed' => ['সেকেন্ড', 'মিনিট', 'ঘন্টা', 'দিন', 'দিন', 'সপ্তাহ', 'মাস'],
    'moments' => ['আগে']
];
const ENGLISH = [
    'numbers' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
    'elapsed' => ['seconds', 'minutes', 'hours', 'day', 'days', 'weeks', 'months'],
    'moments' => ['ago']
];

if (!function_exists('toLocaleString')) {
    /**
     * Get the current local title
     * @param  array|object|null $translate
     * @param  string|null       $local
     * @param  string|null       $pluck
     * @return string|null
     */
    function toLocaleString(array|object|null $translate, ?string $local = 'en', ?string $pluck = 'title'): ?string
    {
        if (isset($translate)) {
            return collect($translate)->where('local', '=', $local)->pluck($pluck)->first();
        }
        return null;
    }
}

if (!function_exists('toLocaleNumber')) {
    /**
     * Interpret the numeric value into locale
     * @param  int|string|null $value
     * @param  string|null     $local
     * @return string
     */
    function toLocaleNumber(int|string|null $value, ?string $local = 'en'): string
    {
        return match ($local) {
            'en' => str_replace(BENGALI['numbers'], ENGLISH['numbers'], $value),
            'bn' => str_replace(ENGLISH['numbers'], BENGALI['numbers'], $value)
        };
    }
}

if (!function_exists('toLocalElapsed')) {
    /**
     * Get the calendar elapsed locale
     * @param  string|null $value
     * @param  string|null $local
     * @return string
     */
    function toLocalElapsed(string|null $value, ?string $local = 'en'): string
    {
        $arrays = explode(' ', $value);
        $parseF = current($arrays);
        $parseS = next($arrays);
        $parseT = next($arrays);
        $string =  match ($local) {
            'en' => [
                str_replace(BENGALI['numbers'], ENGLISH['numbers'], $parseF),
                str_replace(BENGALI['elapsed'], ENGLISH['elapsed'], $parseS),
                str_replace(BENGALI['moments'], ENGLISH['moments'], $parseT),
             ],
            'bn' => [
                str_replace(ENGLISH['numbers'], BENGALI['numbers'], $parseF),
                str_replace(ENGLISH['elapsed'], BENGALI['elapsed'], $parseS),
                str_replace(ENGLISH['moments'], BENGALI['moments'], $parseT),
             ]
        };
        return implode(' ', $string);
    }
}
