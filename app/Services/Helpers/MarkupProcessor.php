<?php

if (!function_exists('toCurrentStatus')) {
    /**
     * Get the current status
     * @param  int|string $status
     * @return string
     */
    function toCurrentStatus(int|string $status): string
    {
        $match = (object) match ((bool) $status) {
            true    => ['color' => 'bg-success', 'image' => 'fa-regular fa-circle-check', 'title' => 'Active'],
            false   => ['color' => 'bg-muted', 'image' => 'fa-solid fa-hourglass-start', 'title' => 'Inactive']
        };
        return sprintf('<span class="badge %s lh-13 rounded-2"><i class="%s fs-10 me-1"></i>%s</span>', $match->color, $match->image, $match->title);
    }
}

if (!function_exists('toFeatureStatus')) {
    /**
     * Get the feature status
     * @param  int|string $status
     * @return string
     */
    function toFeatureStatus(int|string $status): string
    {
        $match = (object) match ((bool) $status) {
            true    => ['color' => 'bg-success', 'image' => 'fa-regular fa-thumbs-up', 'title' => 'Yes'],
            false   => ['color' => 'bg-muted', 'image' => 'fa-regular fa-thumbs-down', 'title' => 'Not']
        };
        return sprintf('<span class="badge %s lh-13 rounded-2"><i class="%s fs-10 me-1"></i>%s</span>', $match->color, $match->image, $match->title);
    }
}

if (!function_exists('toAccountStatus')) {
    /**
     * Get the account status
     * @param  string|null $status
     * @return string
     */
    function toAccountStatus(string|null $status): string
    {
        $match = is_null($status)
            ? (object) ['color' => 'bg-success', 'image' => 'fa-regular fa-circle-check', 'title' => 'Verified']
            : (object) ['color' => 'bg-muted', 'image' => 'fa-solid fa-hourglass-start', 'title' => 'Pending'];
        return sprintf('<span class="badge %s lh-13 rounded-2"><i class="%s fs-10 me-1"></i>%s</span>', $match->color, $match->image, $match->title);
    }
}
