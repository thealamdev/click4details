<?php

namespace App\Http\Livewire\Shared;

use App\Enums\Session;
use App\Enums\Status;
use App\Models\Category;
use App\Models\RentalCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class HeaderShared extends Component
{
    /**
     * Define the categories
     * @var array|object
     */
    public array|object $categories = [];

    /**
     * Define the rental_services
     * @var array|object
     */
    public array|object $rental_category = [];

    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define public property $active
     * @var string
     */
    public $active;

    /**
     * Event listeners for this component
     * @var string[]
     */
    protected $listeners = ['updateLocaleString' => 'toTranslatorString'];

    /**
     * Initialize a new object instance
     * @return void
     */
    public function mount(): void
    {
        $this->categories = Category::query()
            ->withCount(['vehicles' => fn ($q) => $q->where('status', Status::ACTIVE->toString())->where('is_approved', Status::ACTIVE->toString())])
            ->withCount(['property' => fn ($q) => $q->where('status', Status::ACTIVE->toString())->where('is_approved', Status::ACTIVE->toString())])
            ->withCount(['accessory' => fn ($q) => $q->where('status', Status::ACTIVE->toString())->where('is_approved', Status::ACTIVE->toString())])
            ->with('translate')
            ->get();
        $this->rental_category = RentalCategory::query()->where('status', Status::ACTIVE->toString())->get();
    }

    /**
     * Render the theme component
     * @return Application|Factory|View
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function render(): View|Factory|Application
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        return view('livewire.shared.header-shared');
    }

    /**
     * Listen the locale change event
     * @param  string $local
     * @return void
     * @noinspection PhpUnused
     */
    public function toTranslatorString(string $local): void
    {
        $this->translate = $local;
        $this->categories = Category::query()->withCount('vehicles')->with('translate')->get();
    }

    /**
     * Define public function activeCategory() for active the category
     * @return void
     */
    public function activeCategory($id): void
    {
        session()->put('active', $id);
    }
}
