<?php

/** @noinspection ALL */

namespace Illuminate\Contracts\View;

use Illuminate\Contracts\Support\Renderable;

interface View extends Renderable
{
    /**
     * @param  string|null $base
     * @param  array|null  $data
     * @return $this
     */
    public function layout(?string $base = null, ?array $data = []): static;

    /**
     * @param  array|null $data
     * @return $this
     */
    public function layoutData(?array $data = []): static;
}
