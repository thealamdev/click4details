<?php

namespace App\Http\Livewire\RentalService;

use App\Enums\Status;
use App\Enums\Session;
use App\Models\RentCar;
use Livewire\Component;
use App\Models\RentalCategory;

class RentalServiceComponent extends Component
{
    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define public property $rental_categories
     * @var array|object
     */
    public $rental_categories;

    /**
     * Define public property $rent_cars
     * @var array|object
     */
    public array|object $rent_cars = [];

    public function render()
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        $this->rental_categories = RentalCategory::query()->where('status', Status::ACTIVE->toString())->get();
        $this->rent_cars = RentCar::query()->where('status', Status::ACTIVE->toString())->get();
        return view('livewire.rental-service.rental-service-component');
    }
}
