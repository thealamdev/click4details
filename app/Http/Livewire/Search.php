<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Enums\Status;
use App\Enums\Session;
use App\Models\Client;
use App\Models\Vehicle;
use Livewire\Component;
use App\Models\Accessory;
use Illuminate\Support\Str;
use App\Notifications\VehicleView;
use App\Mail\ViewEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class Search extends Component
{
    /**
     * Define the vehicles
     * @var array|object|null
     */
    protected array|object|null $vehicles = [];
    protected array|object|null $accessory = [];

    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Event listeners for this component
     * @var string[]
     */

    public $pagelimit = 10;

    protected $listeners = [
        'updateLocaleString' => 'toTranslatorString'
    ];
    public $search = '';
    public $code = '';
    public $searchTerms;
    public $item;

    /**
     * Listen the locale change event
     * @param  string $local
     * @return void
     * @noinspection PhpUnused
     */
    public function toTranslatorString(string $local): void
    {
        $this->translate    = $local;
        $this->vehicles     = Vehicle::query()->with('brand.translate')->with('grade.translate')->with('image')->with('translate')->where('is_approved', '=', Status::ACTIVE->toString())->latest()->get();
    }

    /**
     * rendering the search of vehicle and accessory.
     */
    public function render()
    {
        $this->search = request('search');
        $this->searchTerms = explode(' ', $this->search);

        if (Route::is('home.vehicle*') || Route::is('home.search*')) {
            $this->vehicles = Vehicle::query()
                ->whereHas('merchant', function ($q) {
                    $q->where('status', 1)
                        ->where('merchant_type', 'partner');
                })
                ->where('is_approved', Status::ACTIVE->toString())
                ->with('brand.translate')
                ->with('edition.translate')
                ->with('fuel.translate')
                ->with('grade.translate')
                ->with('mileage.translate')
                ->with('condition.translate')
                ->with('available.translate')
                ->with('image')
                ->with('translate');

            $this->vehicles->where(function ($query) {
                foreach ($this->searchTerms as $index => $item) {
                    if ($index === 0) {
                        $query->where('slug', 'like', '%' . $item . '%')
                            ->orWhere('code', 'like', '%' . Str::slug($item) . '%');
                    } else {
                        $query->orWhere('slug', 'like', '%' . $item . '%')
                            ->orWhere('code', 'like', '%' .  Str::slug($item) . '%');
                    }
                }
            });

            $this->vehicles = $this->vehicles->orderBy('id','desc')->get();
        }

        if (Route::is('home.vehicle*') || Route::is('home.search*')) {
            $this->accessory = Accessory::query()
                ->where('is_approved', Status::ACTIVE->toString());

            $this->accessory->where(function ($query) {
                foreach ($this->searchTerms as $index => $item) {
                    if ($index === 0) {
                        $query->where('slug', 'like', '%' . $item . '%')
                            ->orWhere('code', 'like', '%' .  Str::slug($item) . '%');
                    } else {
                        $query->orWhere('slug', 'like', '%' . $item . '%')
                            ->orWhere('code', 'like', '%' .  Str::slug($item) . '%');
                    }
                }
            });

            $this->accessory = $this->accessory->get();
        }

        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        return view('livewire.search', ['vehicles' => $this->vehicles, 'accessory' => $this->accessory]);
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
