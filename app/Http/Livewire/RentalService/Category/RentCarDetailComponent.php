<?php

namespace App\Http\Livewire\RentalService\Category;

use App\Enums\Status;
use App\Enums\Session;
use App\Models\RentCar;
use Livewire\Component;

class RentCarDetailComponent extends Component
{
    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define public property $detail
     * @var array|object
     */
    public array|object $detail = [];

    /**
     * Define public method mount()
     * @return void
     */
    public function mount(string $slug)
    {
        $this->detail = RentCar::query()
            ->where('status', Status::ACTIVE->toString())
            ->where('slug', $slug)
            ->with('gallery')
            ->first();
    }

    public function render()
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        return view('livewire.rental-service.category.rent-car-detail-component');
    }
}
