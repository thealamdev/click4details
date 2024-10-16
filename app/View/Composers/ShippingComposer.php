<?php

namespace App\View\Composers;

use App\Enums\Status;
use App\Models\Shipping;
use Illuminate\View\View;

class ShippingComposer
{
    /**
     * Composer response handler
     * @var array|object
     */
    private array|object $response = [];

    /**
     * Create a new composer instance
     * @return void
     */
    final public function __construct()
    {
        $dataCollection = Shipping::query()->with('translate')->orderBy('slug')->where('status', '=', Status::ACTIVE->toString())->get();
        foreach ($dataCollection as $each) {
            $this->response[] = ['id' => $each->id, 'charge' => $each->charge, 'title' => toLocaleString($each->translate)];
        }
    }

    /**
     * Bind data to the view
     * @param  View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('composeShipping', collect($this->response)->map(fn ($i) => (object) $i)->toBase());
    }
}
