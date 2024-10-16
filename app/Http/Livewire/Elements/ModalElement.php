<?php

namespace App\Http\Livewire\Elements;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ModalElement extends Component
{
    /**
     * Define the contact numbers
     * @var array|object
     */
    public array|object $contacts = [];

    /**
     * Initialize a new object instance
     * @return void
     */
    public function mount(): void
    {
        $this->contacts = ['+8801407054422', '+8801407054411', '+8801407054400', '+8801407054404'];
    }

    /**
     * Render the modal component
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('livewire.elements.modal-element');
    }
}
