<?php

namespace App\Http\Livewire;

use App\Enums\Share;
use App\Models\User;
use App\Enums\Status;
use App\Enums\Session;
use App\Models\Client;
use App\Models\Vehicle;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Notifications\VehicleView;
use App\Mail\ViewEmailNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\View\Factory;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;
use Illuminate\Contracts\Foundation\Application;

class DetailManager extends Component
{
    /**
     * Define the incoming product detail
     * @var array|object|null
     */
    protected array|object|null $detail = null;

    public $vehicle_id;

    /**
     * Define the social share link
     * @var array|object|null
     */
    protected array|object|null $shared = [];

    /**
     * Define the product slug
     * @var string|null
     */
    public ?string $slug = null;

    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    /**
     * Define the product slug
     * @var string|null
     */
    public ?string $mobile = null;

    /**
     * Define the masking status
     * @var null|bool
     */
    public ?bool $isMask = null;


    public $suggestions = null;
    /**
     * Event listeners for this component
     * @var string[]
     */
    protected $listeners = ['updateLocaleString' => 'toTranslatorString'];

    /**
     * Initialize a new object instance
     * @param  string|null $slug
     * @return void
     */

    public function mount(string|null $slug): void
    {
        $models = Vehicle::query()->with('carmodel')->with('translate')->where('slug', '=', $this->slug)->first();
        $price = $models?->fixed_price;
        $model =  $models?->carmodel?->id;

        if (!empty($model)) {
            $this->suggestions = Vehicle::query()
                ->where('carmodel_id', '=', $model)
                ->orWhere('price', '=', $price)
                ->whereNot('slug', $this->slug)
                ->with('image')
                ->with('translate')
                ->with('skeleton.translate')
                ->with('mileage.translate')
                ->with('brand.translate')
                ->with('condition.translate')
                ->with('edition.translate')
                ->with('engine.translate')
                ->with('fuel.translate')
                ->with('available.translate')
                ->with('grade.translate')
                ->where('is_approved', '=', Status::ACTIVE->toString())
                ->orderBy('id','desc')
                ->get();
        }

        $this->vehicle_id = Vehicle::where('slug', $this->slug)->select('id')->first();
        $this->slug = $slug;
        $this->detail = Vehicle::with('carmodel.translate')
            ->with('translate')
            ->with('brand.translate')
            ->with('skeleton.translate')
            ->with('mileage.translate')
            ->with('condition.translate')
            ->with('edition.translate')
            ->with('engine.translate')
            ->with('fuel.translate')
            ->with('available.translate')
            ->with('transmission.translate')
            ->with('color.translate')
            ->with('carmodel.translate')
            ->with(['vehicle_feature' => function ($query) {
                $query->where('vehicle_id', $this->vehicle_id->id)->with(['feature', 'detail']);
            }])

            ->where('slug', '=', $this->slug)
            ->first();

        $this->shared = collect(Share::iterator(true))->map(fn ($i) => (object) [
            'name' => $i->toString(), 'icon' => $i->toBrands(), 'link' => $i->toShared($this->detail->slug),
        ])->toBase();
        $this->mobile = '+8801969944400';
        $this->isMask = false;
    }

    /**
     * Render the detail component
     * @return Application|Factory|View
     * @throws NotFoundExceptionInterface|ContainerExceptionInterface
     */
    public function render(): View|Factory|Application
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();
        return view('livewire.detail-manager', ['detail' => $this->detail, 'shared' => $this->shared, 'suggestions' => $this->suggestions]);
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
        $this->detail       = Vehicle::query()->where('slug', '=', $this->slug)->first();
    }

    public function showSellerNumber(string $slug)
    {
        $this->isMask = $this->isMask == true ? false : true;
        $this->slug = $slug;
        $this->detail = Vehicle::query()->with('translate')->where('slug', '=', $this->slug)->first();
        $this->shared = collect(Share::iterator(true))->map(fn ($i) => (object) [
            'name' => $i->toString(), 'icon' => $i->toBrands(), 'link' => $i->toShared($this->detail->slug),
        ])->toBase();
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
        try {
            if ($client) {
                Mail::to($mail->email)->send(new ViewEmailNotification());
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
