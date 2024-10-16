<?php

namespace App\Http\Livewire;

use App\Enums\Status;
use App\Enums\Session;
use Livewire\Component;
use App\Models\Residence;

class FlatManager extends Component
{
    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;
    
    /**
     * Define public property $collections
     * @var array|object
     */
    public array|object $collections = [];

    public function render()
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        $this->collections = Residence::query()
        ->where('status', Status::ACTIVE->toString())
        ->with('completionStatus.translate','furnishedStatus.translate','apartmentComplex.translate')
        ->get();
        return view('livewire.flat-manager');
    }
}
