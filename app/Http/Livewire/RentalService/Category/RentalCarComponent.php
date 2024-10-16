<?php

namespace App\Http\Livewire\RentalService\Category;

use App\Enums\Session;
use App\Enums\Status;
use App\Models\RentCar;
use Livewire\Component;

class RentalCarComponent extends Component
{
    /**
     * Define a public property $responses
     * @var array<strng,int>
     */
    public $responses;

    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define a public method mount()
     * @return void
     */
    public function mount(): void
    {
        $this->responses = RentCar::query()->where('status',Status::ACTIVE->toString())->with('image','carmodel', 'translate')->get();
    }
    public function render()
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        return view('livewire.rental-service.category.rental-car-component');
    }
}
