<?php

namespace App\Http\Livewire\Plugin;

use App\Enums\Session;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class LocalePlugin extends Component
{
    /**
     * Define the schema
     * @var array
     */
    private const SCHEMA = [
        'en' => ['name' => 'English', 'abbr' => 'en', 'flag' => 'us'],
        'bn' => ['name' => 'Bengali', 'abbr' => 'bn', 'flag' => 'bd'],
    ];

    /**
     * Listen the events
     * @var string[]
     */
    protected $listeners = ['changeLocal' => '$refresh'];

    /**
     * Define the current status
     * @var string|null
     */
    public ?string $lang = null;

    /**
     * Define the font icon
     * @var string|null
     */
    public ?string $flag = null;

    /**
     * Initialize a new object instance
     * @return void
     */
    public function mount(): void
    {
        // TODO: Implement mount() method
    }

    /**
     * Render the locale component
     * @return Application|Factory|View
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */

     
    public function render(): View|Factory|Application
    {
        $currLocale = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        $this->lang = self::SCHEMA[$currLocale]['name'];
        $this->flag = self::SCHEMA[$currLocale]['flag'];
        return view('livewire.plugin.locale-plugin', [
            'languages' => collect(self::SCHEMA)->map(fn ($i) => (object) $i)->toBase()
        ]);
    }

 
     

    /**
     * Change current local language
     * @param  string $local
     * @return void
     * @noinspection PhpUnused
     */
    public function changeLocal(string $local): void
    {
        $this->lang = self::SCHEMA[$local]['name'];
        $this->flag = self::SCHEMA[$local]['flag'];
        session()->put(Session::TRANSLATION->toString(), $local);
        $this->emit('updateLocaleString', $local);
    }
}
