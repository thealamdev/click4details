<?php

namespace App\View\Composers;

use App\Models\Merchant;
use Illuminate\View\View;

class MerchantComposer
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
        $this->response = Merchant::query()->select(['id', 'name', 'email'])->get();
    }

    /**
     * Bind data to the view
     * @param  View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('composeMerchant', $this->response);
    }
}
