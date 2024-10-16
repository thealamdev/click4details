<?php

namespace App\View\Composers;

use App\Enums\Status;
use App\Models\Sizeunit;
use Illuminate\View\View;

class SizeUnitComposer
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
        $dataCollection = Sizeunit::query()->with('translate')->orderBy('slug')->where('status', '=', Status::ACTIVE->toString())->get(['id', 'slug']);
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
        $view->with('composeSizeUnit', collect($this->response)->map(fn ($i) => (object) $i)->toBase());
    }
}
