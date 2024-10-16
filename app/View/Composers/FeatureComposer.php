<?php

namespace App\View\Composers;

use App\Enums\Status;
use App\Models\Detail;
use Illuminate\View\View;

class FeatureComposer
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
        $dataCollection = Detail::query()->where('status', '=', Status::ACTIVE->toString())->get();
        foreach ($dataCollection as $each) {
            $this->response[] = ['id' => $each->id, 'title' => $each->title];
        }
    }

    /**
     * Bind data to the view
     * @param  View $view
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('composeFeature', collect($this->response)->map(fn ($i) => (object) $i)->toBase());
    }
}
