<?php

namespace App\View\Composers;

use App\Enums\Status;
use App\Models\Engine;
use Illuminate\View\View;

class EngineComposer
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
        $dataCollection = Engine::query()->with('translate')->orderBy('slug')->where('status', '=', Status::ACTIVE->toString())->get();
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
        $view->with('composeEngine', collect($this->response)->map(fn ($i) => (object) $i)->toBase());
    }
}
