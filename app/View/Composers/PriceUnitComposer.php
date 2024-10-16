<?php

namespace App\View\Composers;

use App\Enums\Status;
use App\Models\Priceunit;
use Illuminate\View\View;

class PriceUnitComposer
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
        $dataCollection = Priceunit::query()->with('translate')->orderBy('slug')->where('status', '=', Status::ACTIVE->toString())->get(['id', 'slug']);
        foreach ($dataCollection as $each) {
            $this->response[] = ['id' => $each->id, 'title' => toLocaleString($each->translate)];
        }
    }

    /**
     * Bind data to the view
     * @param  View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('composePriceUnit', collect($this->response)->map(fn ($i) => (object) $i)->toBase());
    }
}
