<?php

namespace App\Http\Livewire\Shared;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FooterShared extends Component
{
    /**
     * Define the social media's
     * @var array|object
     */
    private array|object $socials = [];

    /**
     * Initialize a new object instance
     * @return void
     */
    public function mount(): void
    {
        $this->socials = array_map(fn ($i) => (object) $i, [
            ['icon' => 'fa-brands fa-twitter', 'link' => 'javascript:;'],
            ['icon' => 'fa-brands fa-instagram', 'link' => 'javascript:;'],
            ['icon' => 'fa-brands fa-facebook', 'link' => 'https://www.facebook.com/pilotbazarbd/'],
        ]);
    }

    /**
     * Render the theme component
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('livewire.shared.footer-shared', ['socials' => $this->socials]);
    }
}
