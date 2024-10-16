<?php

namespace App\Http\Livewire;

use App\Enums\Session;
use App\Enums\Status;
use App\Models\Accessory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class AccessoryManager extends Component
{
    
    public $searchTerm = '';

    protected array|object $accessory = [];
     
    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    
    public string|null $price = null;

    /**
     * Define the order selected
     * @var string|null
     */
    public string|null $order = null;

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
        // dd($this->accessory);
        return view('livewire.accessory-manager', [
            'accessory'      => $this->accessory
        ]);
    }

    /**
     * Filter the vehicle components
     * @return void
     */
    // public function filterVehiclesData(): void
    // {
    //     if($this->order == 1){
    //         $this->order = 'asc';
    //     }else{
    //         $this->order = 'desc';
    //     }

    //     $this->accessory = Accessory::query()
    //         // ->when($this->skeleton != "", fn ($query) => $query->where('skeleton_id', '=', $this->skeleton))
    //         ->where('is_approved', '=', Status::ACTIVE->toString())
    //         ->orderBy('id',"$this->order")
    //         ->get();
    //     // $this->render();

    //     // dd($this->accessory);
    //     $this->composers();
    // }

    public function filterVehiclesData(): void
{
    if ($this->order == 1) {
        $this->order = 'asc';
    } else {
        $this->order = 'desc';
    }

    $query = Accessory::query()
        ->where('is_approved', '=', Status::ACTIVE->toString())
        ->orderBy('id', $this->order);

    // Check if search term is provided and apply search filter
    if (!empty($this->searchTerm)) {
        $query->where('slug', 'like', '%' . $this->searchTerm . '%');
    }

    // Fetch the accessories based on the filters
    $this->accessory = $query->get();

    $this->composers();
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
        $this->composers();
    }

    /**
     * Reusable properties collection
     * @return void
     */
    private function composers(): void
    {
        $this->accessory = Accessory::query()
        ->with('translate')
        ->with('image')
        ->with('brand.translate')
        ->where('is_approved', '=', Status::ACTIVE->toString())
        ->latest()
        ->get();
    }
}
