<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Enums\Status;
use App\Models\Brand;
use App\Enums\Session;
use App\Models\Client;
use App\Models\Mileage;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Skeleton;
use App\Models\Condition;
use App\Models\Transmission;
use App\Notifications\VehicleView;
use App\Mail\ViewEmailNotification;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\Factory;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Illuminate\Contracts\Foundation\Application;

class VehicleManager extends Component
{

    /**
     * Define the vehicles
     * @var array|object
     */
    protected array|object $vehicles = [];

    /**
     * Define the brands
     * @var array|object
     */
    protected array|object $brands = [];

    /**
     * Define the conditions
     * @var array|object
     */
    protected array|object $conditions = [];

    /**
     * Define the mileages
     * @var array|object
     */
    protected array|object $mileages = [];

    /**
     * Define the skeletons
     * @var array|object
     */
    protected array|object $skeletons = [];

    /**
     * Define the transmissions
     * @var array|object
     */
    protected array|object $transmissions = [];

    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define the brand selected
     * @var string|null
     */
    public string|null $brand = null;

    /**
     * Define the condition selected
     * @var string|null
     */
    public string|null $condition = null;

    /**
     * Define the mileage selected
     * @var string|null
     */
    public string|null $mileage = null;

    /**
     * Define the skeleton selected
     * @var string|null
     */
    public string|null $skeleton = null;

    /**
     * Define the price selected
     * @var string|null
     */
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
        return view('livewire.vehicle-manager', [
            'brands'        => $this->brands,
            'conditions'    => $this->conditions,
            'mileages'      => $this->mileages,
            'skeletons'     => $this->skeletons,
            'transmissions' => $this->transmissions,
            'vehicles'      => $this->vehicles
        ]);
    }

    /**
     * Filter the vehicle components
     * @return void
     */
    public function filterVehiclesData(): void
    {
        $this->vehicles = Vehicle::query()
            ->whereHas('merchant', function ($q) {
                $q->where('status', 1)
                    ->where('merchant_type', 'partner');
            })
            ->when($this->brand != "", fn ($query) => $query->where('brand_id', '=', $this->brand))
            ->when($this->condition != "", fn ($query) => $query->where('condition_id', '=', $this->condition))
            ->when($this->mileage != "", fn ($query) => $query->where('mileage_id', '=', $this->mileage))
            ->when($this->skeleton != "", fn ($query) => $query->where('skeleton_id', '=', $this->skeleton))
            ->where('is_approved', '=', Status::ACTIVE->toString())
            ->latest()->get();
        $this->render();

        // $this->composers();
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
        $this->brands           = Brand::query()->with('image')->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->conditions       = Condition::query()->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->mileages         = Mileage::query()->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->skeletons        = Skeleton::query()->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->transmissions    = Transmission::query()->with('translate')->where('status', '=', Status::ACTIVE->toString())->latest()->get(['id', 'slug']);
        $this->vehicles         = Vehicle::query()
            ->whereHas('merchant', function ($q) {
                $q->where('status', 1)
                    ->where('merchant_type', 'partner');
            })
            ->with('image')
            ->with('translate')
            ->with('grade.translate')
            ->with('condition.translate')
            ->with('available.translate')
            ->with('mileage.translate')
            ->where('is_approved', '=', Status::ACTIVE->toString())->latest()->get();
    }

    /**
     * method for viewCount.
     * @param $id.
     */
    public function viewCount($id)
    {
        $users = User::all();
        $vehicleCount = Vehicle::find($id);
        $client_id = Auth::guard('client')->check();
        $client = Auth::guard('client')->check();
        if ($client) {
            $client_id = Auth::guard('client')->user()->id;
        }

        foreach ($users as $user) {
            $vehicleData = $vehicleCount->toArray();
            $vehicleData['client_id'] = $client_id;
            $user->notify(new VehicleView($vehicleData));
        }

        $mail = Client::find($client_id, ['email']);
        // dd($mail);
        try {
            if ($client) {
                Mail::to($mail->email)->send(new ViewEmailNotification());
            }
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it or display an error message)
            dd($e->getMessage());
        }
    }
}
