<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DefaultLayout extends Component
{
    /**
     * Create a new component instance
     * @return void
     */
    public function __construct()
    {
        // TODO: Your Code Here...
    }

    /**
     * Get the view or contents that represent the component
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.default');
    }
}
