<?php

namespace App\Http\Livewire\Plugin;

use App\Enums\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ThemePlugin extends Component
{
    /**
     * Define the schema
     * @var array
     */
    private const SCHEMA = [
        'light' => ['name' => 'Light', 'icon' => 'fa-regular fa-sun'],
        'dark'  => ['name' => 'Dark', 'icon' => 'fa-solid fa-moon'],
        'auto'  => ['name' => 'Auto', 'icon' => 'fa-solid fa-circle-half-stroke']
    ];

    /**
     * Listen the events
     * @var string[]
     */
    protected $listeners = ['changeColor' => '$refresh'];

    /**
     * Define the current status
     * @var string|null
     */
    public ?string $base = null;

    /**
     * Define the font icon
     * @var string|null
     */
    public ?string $icon = null;

    /**
     * Initialize a new object instance
     * @return void
     */
    public function mount(): void
    {
        // TODO: Implement mount() method
    }

    /**
     * Render the theme component
     * @return Application|Factory|View
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function render(): View|Factory|Application
    {
        $currSchema = session()->get(Session::COLOR_THEME->toString()) ?? 'auto';
        $this->base = self::SCHEMA[$currSchema]['name'];
        $this->icon = self::SCHEMA[$currSchema]['icon'];
        return view('livewire.plugin.theme-plugin', [
            'themes' => collect(self::SCHEMA)->map(fn ($i) => (object) $i)->toBase()
        ]);
    }

    /**
     * Change current color schema
     * @param  string $color
     * @return void
     * @noinspection PhpUnused
     */
    public function changeColor(string $color): void
    {
        $this->base = self::SCHEMA[$color]['name'];
        $this->icon = self::SCHEMA[$color]['icon'];
        session()->put(Session::COLOR_THEME->toString(), $color);
    }
}
