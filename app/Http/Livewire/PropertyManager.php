<?php

namespace App\Http\Livewire;

use App\Enums\Session;
use App\Enums\Status;
use App\Models\Brand;
use App\Models\Condition;
use App\Models\Mileage;
use App\Models\Priceunit;
use App\Models\Property;
use App\Models\Sizeunit;
use App\Models\Skeleton;
use App\Models\Transmission;
use App\Models\Type;
use App\Models\Vehicle;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PropertyManager extends Component
{
    
    protected array|object $property = [];
    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define the price selected
     * @var string|null
     */
    public string|null $price = null;

    public $type;

    public $priceunit;
    
    public $sizeunit;

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
        $this->composers();
    }

    /**
     * Render the vehicle component
     * @return Application|Factory|View
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function render(): View|Factory|Application
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        return view('livewire.property-manager', [
            'type'        => $this->type,
            'priceunit'    => $this->priceunit,
            'sizeunit'      => $this->sizeunit,
            'property'      => $this->property
        ]);
    }

    /**
     * Filter the vehicle components
     * @return void
     */
    // public function filterVehiclesData(): void
    // {
    //     $this->vehicles = Vehicle::query()
    //         ->when($this->brand != "", fn ($query) => $query->where('brand_id', '=', $this->brand))
    //         ->when($this->condition != "", fn ($query) => $query->where('condition_id', '=', $this->condition))
    //         ->when($this->mileage != "", fn ($query) => $query->where('mileage_id', '=', $this->mileage))
    //         ->when($this->skeleton != "", fn ($query) => $query->where('skeleton_id', '=', $this->skeleton))
    //         ->where('is_approved', '=', Status::ACTIVE->toString())
    //         ->latest()->get();
    //     $this->render();

    //     // $this->composers();
    // }

    /**
     * Listen the locale change event
     * @param  string $local
     * @return void
     * @noinspection PhpUnused
     */
    public function toTranslatorString(string $local): void
    {
        $this->translate = $local;
        $this->composers();
    }

    /**
     * Reusable properties collection
     * @return void
     */
    private function composers(): void
    {
        $this->type             = Type::query()->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->priceunit        = Priceunit::query()->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->sizeunit         = Sizeunit::query()->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->property         = Property::query()->where('is_approved', '=', Status::ACTIVE->toString())->latest()->get();
    }
}
