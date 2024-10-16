<?php

namespace App\Http\Livewire\Shared;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class NavbarShared extends Component
{
    /**
     * Define the navigations
     * @var array|object
     */
    private array|object $navigators = [];

    /**
     * Initialize a new object instance
     * @return void
     */
    public function mount(): void
    {
        $this->navigators = array_map(fn ($i) => (object) $i, [
            ['name' => 'Home', 'link' => 'home.index'],
            ['name' => 'Impoter Login', 'link' => 'merchant.login.create'],
            ['name' => 'About Us', 'link' => ''],
            ['name' => 'Contact Us', 'link' => ''],
        ]);
    }

    /**
     * Render the theme component
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('livewire.shared.navbar-shared', ['navigators' => $this->navigators]);
    }
}
