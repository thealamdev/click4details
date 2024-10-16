<?php

namespace App\Http\Livewire;

use App\Enums\Session;
use App\Enums\Status;
use App\Mail\ViewEmailNotification;
use App\Models\Client;
use App\Models\User;
use App\Models\Vehicle;
use App\Notifications\VehicleView;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeManager extends Component
{

    public $vehicleCount;
    /**
     * Define the vehicles
     * @var array|object|null
     */
    protected array|object|null $vehicles = [];

    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define a public property $limitPerPage
     * @var string
     */
    public $limitPerPage = 20;

    /**
     * Define protected property $listeners
     * @var array|object
     */
    protected $listeners = [
        'load-more' => 'loadMore',
        'updateLocaleString' => 'toTranslatorString',
    ];

    /**
     * Define public method loadMore() to load more product
     * @return void
     */
    public function loadMore(): void
    {
        $this->limitPerPage = $this->limitPerPage + 10;
    }

    /**
     * Define public method mount()
     * @return void
     */
    public function mount(): void
    {
        session()->put('active', 1);
    }

    /**
     * Render the home component
     * @return Application|Factory|View
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */

    public function render(): View|Factory|Application
    {
        $this->vehicles = Vehicle::query()
            ->with('brand')
            ->with('edition')
            ->with('fuel')
            ->with('grade')
            ->with('condition')
            ->with('availability')
            ->with('image')
            ->limit(10)->get();

        return view('livewire.home-manager', ['vehicles' => $this->vehicles]);
    }

    /**
     * Listen the locale change event
     * @param  string $local
     * @return void
     * @noinspection PhpUnused
     */
    public function toTranslatorString(string $local): void
    {
        $this->translate    = $local;
        $this->vehicles     = Vehicle::query()->with('grade')->with('image')->with('translate')->where('is_approved', '=', Status::ACTIVE->toString())->latest()->get();
    }

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
