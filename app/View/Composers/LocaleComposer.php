<?php

namespace App\View\Composers;

use App\Enums\Locale;
use Illuminate\View\View;

class LocaleComposer
{
    /**
     * Composer response handler
     * @var array|object
     */
    private array|object $response;

    /**
     * Create a new composer instance
     * @return void
     */
    final public function __construct()
    {
        $this->response = Locale::cases();
    }

    /**
     * Bind data to the view
     * @param  View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('composeLocale', $this->response);
    }
}
