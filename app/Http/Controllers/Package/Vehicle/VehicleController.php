<?php

namespace App\Http\Controllers\Package\Vehicle;

use Carbon\Carbon;
use App\Models\Code;
use App\Models\User;
use App\Enums\Status;
use App\Enums\Session;
use App\Models\Client;
use App\Models\Package;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VehicleFeatur;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\VehicleNotification;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Package\Vehicle\UpdateVehicleRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\VehicleHandler;

class VehicleController extends Controller
{
    public $client = null;
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
     * Event listeners for this component
     * @var string[]
     */
    public $status;

    /**
     * Initialize a new object instance
     * @return void
     */

    protected $listeners = [
        'load-more' => 'loadMore',  // For loading more data on scroll down
        'updateLocaleString' => 'toTranslatorString',  // For updating the translation
    ];

    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $products = Vehicle::query()->select('id', 'slug', 'merchant_id', 'brand_id', 'edition_id', 'condition_id', 'transmission_id', 'engine_id', 'fuel_id', 'skeleton_id', 'available_id', 'mileage_id', 'chassis_number', 'engine_number', 'manufacture', 'purchase_price','additional_price', 'fixed_price', 'price', 'mileages', 'engines', 'code', 'registration', 'status', 'updated_at')
            ->with('translate', fn ($query) => $query->select('local', 'translate_id', 'title'))
            ->with('merchant', fn ($query) => $query->select(['id', 'name']))
            ->with('brand', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('edition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('condition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('transmission', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('engine', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('fuel', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('skeleton', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('mileage', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('description')
            ->orderBy('id', 'desc')
            ->get();

        return view('content.package.vehicle.product.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        $codes = [];
        $options = [];
        if ($request->ajax()) {
            $merchant_id = $request->merchant_id;
            $firstArray = Vehicle::select('code')->pluck('code')->toArray();
            $secondArray = Code::where('merchant_id', $merchant_id)->pluck('code')->toArray();

            $filteredArray = array_filter($secondArray, function ($item) use ($firstArray) {
                return !in_array($item, $firstArray);
            });

            $codes = array_values($filteredArray);

            $options[] = "<option selected disabled>-- Select Code --</option>";
            foreach ($codes as $code) {
                $options[] = "<option value='$code'>" . $code . "</option>";
            }

            $edition_id = $request->edition_id;
            $features = Package::where('edition_id', $edition_id)
                ->with(['edition', 'detail_feature' => function ($q) use ($edition_id) {
                    $q->where('edition_id', $edition_id)
                        ->with('feature', 'detail');
                }])
                ->latest()->first();

            $response = [
                'options' => implode("", $options),
                'features' => $features,
            ];

            return response()->json($response);
        }

        return view('content.package.vehicle.product.create', compact('codes'));
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreVehicleRequest $request
     * @param  VehicleHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreVehicleRequest $request, VehicleHandler $handler): RedirectResponse
    {
        $users = User::all();
        if ($request->validated()) {
            $isCreate = $handler->store($request);

            $recordsToInsert = [];
            if ($request->detail_id !== null) {
                if ($isCreate) {
                    foreach ($request->detail_id as $feature_id => $detail_ids) {
                        foreach ($detail_ids as $detail_id) {
                            $recordsToInsert[] = [
                                'vehicle_id' => $isCreate->getKey(),
                                'slug' => $isCreate->slug,
                                'edition_id' => $request->edition_id,
                                'featur_id' => $feature_id,
                                'detail_id' => $detail_id
                            ];
                        }
                    }
                }
            }

            if (!empty($recordsToInsert)) {
                VehicleFeatur::insert($recordsToInsert);
            }

            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a record';
            foreach ($users as $user) {
                $user->notify(new VehicleNotification($isCreate->toArray()));
            }
            return Redirect::route('admin.vehicle.description.index', ['vehicle' => $isCreate->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Vehicle $product
     * @return void
     */
    public function show(Vehicle $product): void
    {
        // TODO: Implement show() method
    }


    public function edit(Request $request, Vehicle $product)
    {
        $codes = Code::where('merchant_id', $product->merchant_id)->pluck('code')->toArray();
        $options = [];
        if ($request->ajax()) {
            $merchant_id = $request->merchant_id;
            $edition_id = $request->edition_id;

            $firstArray = Vehicle::select('code')->pluck('code')->toArray();
            $secondArray = Code::where('merchant_id', $merchant_id)->pluck('code')->toArray();

            $filteredArray = array_filter($secondArray, function ($item) use ($firstArray) {
                return !in_array($item, $firstArray);
            });

            $codes = array_values($filteredArray);

            $options[] = "<option selected disabled>-- Select Code --</option>";
            foreach ($codes as $code) {
                $options[] = "<option value='$code'>" . $code . "</option>";
            }


            $active_details = VehicleFeatur::where('vehicle_id', $request->product_id)
                ->where('edition_id', $edition_id)
                ->get();
            $features = Package::where('edition_id', $edition_id)
                ->with(['edition', 'detail_feature' => function ($q) use ($edition_id) {
                    $q->where('edition_id', $edition_id)
                        ->with('feature', 'detail');
                }])
                ->latest()->first();

            $response = [
                'options' => implode("", $options),
                'features' => $features,
                'active_details' => $active_details
            ];

            return response()->json($response);
        }

        return view('content.package.vehicle.product.update', compact('product', 'codes'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateVehicleRequest $request
     * @param  Vehicle              $product
     * @param  VehicleHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateVehicleRequest $request, Vehicle $product, VehicleHandler $handler)
    {
        // return $request;
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $product);

            if ($request->detail_id !== null) {
                VehicleFeatur::where('vehicle_id', $product->id)->delete();
                $recordsToInsert = [];

                foreach ($request->detail_id as $feature_id => $detail_ids) {
                    foreach ($detail_ids as $detail_id) {
                        $recordsToInsert[] = [
                            'vehicle_id' => $product->getKey(),
                            'slug' => $isUpdate->slug,
                            'edition_id' => $request->edition_id,
                            'featur_id' => $feature_id,
                            'detail_id' => $detail_id
                        ];
                    }
                }

                if (!empty($recordsToInsert)) {
                    VehicleFeatur::insert($recordsToInsert);
                }
            }

            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update vehicle resource';
            return Redirect::route('admin.vehicle.description.index', ['vehicle' => $product->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Vehicle          $product
     * @param  VehicleHandler   $handler
     * @return RedirectResponse
     */
    public function destroy(Vehicle $product, VehicleHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($product);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete vehicle resource';
        return Redirect::back()->with('status', $response);
    }

    /**
     * Show the form for manage product details resource
     * @return Application|Factory|View
     */
    public function detail(): View|Factory|Application
    {
        return view('content.package.vehicle.product.detail');
    }

    /**
     * Show the form for manage product gallery resource
     * @return Application|Factory|View
     */
    public function gallery(): View|Factory|Application
    {
        return view('content.package.vehicle.product.gallery');
    }

    public function toTranslatorString(string $local)
    {
        $this->translate = $local;
        $this->vehicles = Vehicle::query()
            ->with('grade')
            ->with('image')
            ->with('translate')
            ->where('is_approved', '=', Status::ACTIVE->toString())
            ->latest()
            ->get();
    }

    public function search(Request $request)
    {
        $this->translate = session()->get(Session::TRANSLATION->toString()) ?? app()->getLocale();

        $this->vehicles = Vehicle::query()
            ->where('code', $request->input('value'))
            ->with('grade')
            ->with('image')
            ->with('translate')
            ->get();

        return view('livewire.home-manager', [
            'vehicles' => $this->vehicles,
            'translate' => $this->translate,
        ]);
    }

    public function secure(Request $request)
    {

        if ($request->all()) {

            if ($request->status) {
                if ($request->status == '1') {
                    $this->status = Status::ACTIVE->toString();
                } elseif ($request->status == '2') {
                    $this->status = Status::INACTIVE->toString();
                }
            }

            $vehicles = Vehicle::where(function ($q) use ($request) {
                if ($request->vehicles_name) {
                    $slug = Str::slug($request->vehicles_name);
                    $q->where('slug', $slug);
                }
                if ($request->code) {
                    $q->where('code', $request->code);
                }
                if ($request->status) {
                    $q->where('is_approved', '=', $this->status);
                }
                if ($request->start_date && $request->end_date) {
                    $q->WhereBetween('created_at', [
                        Carbon::createFromFormat('Y-m-d', $request->start_date),
                        Carbon::createFromFormat('Y-m-d', $request->end_date)
                    ]);
                }
                if ($request->start_date && $request->end_date == null) {
                    $q->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $request->start_date));
                }
            })
                ->get();
        } else {
            $vehicles = Vehicle::query()
                ->with('merchant', fn ($query) => $query->select(['id', 'name']))
                ->with('brand', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('edition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('condition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('transmission', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('engine', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('fuel', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('skeleton', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('mileage', fn ($query) => $query->with('translate')->select(['id', 'slug']))
                ->where('is_approved', '=', Status::INACTIVE->toString())
                ->get();
        }

        return view('content.package.vehicle.product.pending', compact('vehicles'));
    }

    public function notification($id)
    {
        $client = '';
        $user_id = auth()->user()?->id;
        $user = User::find($user_id);
        $user->notifications->where('id', $id)->markAsRead();
        $notify = $user->notifications->where('id', $id)->first();

        // Vehicle View Notification: 
        if ($notify->type === 'App\Notifications\VehicleView') {
            $client_id = $notify->data['client_id'];
            $client = Client::find($client_id);
        }

        // Vehicle Create Notification:
        if ($notify->type === 'App\Notifications\VehicleNotification') {
            return redirect(route('admin.vehicle.product.edit', ['product' => $notify->data['id']]));
        }

        // Accessory Order Notification: 
        if ($notify->type === 'App\Notifications\AccessoryNotification') {
            return redirect(route('admin.accessory.order.show', ['order' => $notify->data['id']]));
        }

        return view('content.package.notification.notifications', compact('notify', 'client'));
    }

    public function notificationRead()
    {
        foreach (auth()->user()->notifications  as $notify) {
            $notify->markAsRead();
        }
        return back();
    }

    public function VehicleWhatsApp($slug)
    {
        $detail = Vehicle::query()->with('translate')->where('slug', '=', $slug)->first();
        return view('content.package.vehicle.product.whatsappView', compact('detail'));
    }
}
