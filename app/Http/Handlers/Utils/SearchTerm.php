<?php

namespace App\Http\Handlers\Utils;

use App\Models\Customer;


trait SearchTerm
{
    /**
     * Define public method findId() for identify the search term as customer id
     * @param string $search
     * @return bool
     */
    public function findId(string $search)
    {
        $ids = Customer::query()->pluck('id')->toArray();
        return in_array($search, $ids);
    }

    /**
     * Define public method findNumber() to identify the search term as mobile number
     * @param string $search
     * @return string|bool
     */
    public function findMobile(string $search)
    {
        $characters = str_split(strval($search));
        $firstCharacter = array_shift($characters);
        if ($firstCharacter === '0') {
            return implode('', $characters);
        }
    }

    /**
     * Define public method findPercent() method for identify the search term as seriousness of customer
     * @param string $search
     * @return bool
     */
    public function findPercent(string $search): bool
    {
        return strpos($search, '%') !== false;
    }
}
