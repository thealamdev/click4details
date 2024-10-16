<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use Carbon\Carbon;
use App\Models\Code;
use App\Models\User;
use App\Enums\Status;
use App\Models\Package;
use App\Models\Vehicle;
use App\Models\Merchant;
use App\Models\Available;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendVehicleMail;
use App\Models\VehicleFeatur;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use App\Models\CustomMerchanVehicletTable;
use App\Notifications\VehicleNotification;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Package\Vehicle\UpdateVehicleRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\VehicleHandler;

class VehicleController extends Controller
{

    public $client = null;
    // mycode start
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

    //my code end
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $custom = CustomMerchanVehicletTable::where('merchant_id', auth()->user()?->id)->first();
        $merchant_id = auth()->user('merchant')->id;
        $products = Vehicle::query()->latest()->where('merchant_id', $merchant_id)
            ->where('status', Status::ACTIVE->toString())
            ->with(['vehicle_feature' => function ($query) {
                $query->with('feature', 'detail');
            }])
            ->with('merchant', fn($query) => $query->select(['id', 'name']))
            ->with('brand', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('edition', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('condition', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('transmission', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('engine', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('fuel', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('skeleton', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('mileage', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->get();
        return view('content.merchant.vehicle.product.index', compact('products', 'custom'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        $firstArray = Vehicle::select('code')->pluck('code')->toArray();
        $secondArray = Code::where('merchant_id', auth()->user()->id)->pluck('code')->toArray();

        $filteredArray = array_filter($secondArray, function ($item) use ($firstArray) {
            return !in_array($item, $firstArray);
        });

        $codes = array_values($filteredArray);

        if ($request->ajax()) {
            $edition_id = $request->edition_id;
            $features = Package::where('edition_id', $edition_id)
                ->with(['edition', 'detail_feature' => function ($q) use ($edition_id) {
                    $q->where('edition_id', $edition_id)
                        ->with('feature', 'detail');
                }])
                ->latest()->first();

            $response = [
                'features' => $features,
            ];
            return response()->json($response);
        }

        return view('content.merchant.vehicle.product.create', compact('codes'));
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreVehicleRequest $request
     * @param  VehicleHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreVehicleRequest $request, VehicleHandler $handler)
    {
        $users = User::all();
        if ($request->validated()) {
            $isCreate = $handler->store($request);

            if ($request->detail_id !== null && $isCreate) {
                $records = [];
                foreach ($request->detail_id as $feature_id => $detail_ids) {
                    foreach ($detail_ids as $detail_id) {
                        $records[] = [
                            'vehicle_id' => $isCreate->getKey(),
                            'slug' => $isCreate->slug,
                            'edition_id' => $request->edition_id,
                            'featur_id' => $feature_id,
                            'detail_id' => $detail_id,
                        ];
                    }
                }

                VehicleFeatur::insert($records);
            }

            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a record';
            foreach ($users as $user) {
                $user->notify(new VehicleNotification($isCreate->toArray()));
            }

            return Redirect::route('merchant.vehicle.description.index', ['vehicle' => $isCreate->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * method for rendering all vehicles in merchant panel.
     * @param Request $request
     */
    public function show(Request $request)
    {
        $merchant_id  = $request->user()?->id;
        $vehicles = Vehicle::with('translate')
            ->where('status', Status::ACTIVE->toString())
            ->with(['vehicle_feature' => function ($query) {
                $query->with(['feature', 'detail']);
            }])
            ->with('carmodel.translate')
            ->with('condition.translate')
            ->with('available.translate')
            ->with('engine.translate')
            ->with('mileage.translate')
            ->with('fuel.translate')
            ->with('grade.translate')
            ->with('image')
            ->where('merchant_id', $merchant_id)->get();
        return view('content.merchant.vehicle.product.show', compact('vehicles', 'merchant_id'));
    }

    /**
     * Define public method view()
     * @param Request $request 
     * @var <string> $slug
     */
    public function view(Request $request, $slug)
    {
        $vehicle_id = Vehicle::where('slug', $slug)->select('id', 'merchant_id')->first();
        $merchant_id =  $vehicle_id->merchant_id;
        $product = Vehicle::with(['vehicle_feature' => function ($query) use ($vehicle_id) {
            $query->where('vehicle_id', $vehicle_id->id)->with(['feature', 'detail']);
        }])->with('translate')
            ->where('slug', '=', $slug)
            ->first();

        $models = Vehicle::query()->with('carmodel')->with('translate')->where('slug', '=', $slug)->first();
        $price = $models?->fixed_price;
        $model =  $models?->carmodel?->id;

        if (!empty($model)) {
            $suggestions = Vehicle::query()
                ->where('merchant_id', $merchant_id)
                ->where('carmodel_id', '=', $model)
                ->orWhere('price', '=', $price)
                ->whereNot('slug', $slug)
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
                ->get();
        }

        return view('content.merchant.vehicle.product.view', compact('product', 'suggestions'));
    }

    /**
     * Show the form for editing the specified resource
     * @param  Vehicle                  $product
     * @return Application|Factory|View
     */
    public function edit(Request $request, Vehicle $product)
    {
        $codes = Code::where('merchant_id', auth()->user()->id)->pluck('code')->toArray();
        if ($request->ajax()) {
            $edition_id = $request->edition_id;
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
                'features' => $features,
                'active_details' => $active_details
            ];

            return response()->json($response);
        }
        return view('content.merchant.vehicle.product.edit', compact('product', 'codes'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateVehicleRequest $request
     * @param  Vehicle              $product
     * @param  VehicleHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateVehicleRequest $request, Vehicle $product, VehicleHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $product);

            if ($request->detail_id !== null) {
                VehicleFeatur::where('vehicle_id', $product->id)->delete();
                $records = [];
                foreach ($request->detail_id as $feature_id => $detail_ids) {
                    foreach ($detail_ids as $detail_id) {
                        $records[] = [
                            'vehicle_id' => $product->getKey(),
                            'slug' => $product->slug,
                            'edition_id' => $request->edition_id,
                            'featur_id' => $feature_id,
                            'detail_id' => $detail_id,
                        ];
                    }
                }

                VehicleFeatur::insert($records);
            }


            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update vehicle resource';
            return Redirect::route('merchant.vehicle.description.index', ['vehicle' => $product->getKey()])->with('status', $response);
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

    public function secure(Request $request)
    {
        $merchant_id  = Auth::guard('merchant')->user()?->id;
        if ($request->all()) {

            if ($request->status) {
                if ($request->status == '1') {
                    $this->status = Status::ACTIVE->toString();
                } elseif ($request->status == '2') {
                    $this->status = Status::INACTIVE->toString();
                }
            }

            $vehicles = Vehicle::where('merchant_id', auth()->user()?->id)->where(function ($q) use ($request) {
                if ($request->vehicles_name) {
                    $q->where('slug', 'LIKE', '%' . Str::slug($request->vehicles_name) . '%');
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
                ->orderBy('updated_at', 'desc')
                ->get();
        } else {
            $vehicles = Vehicle::query()
                ->where('merchant_id', auth()->user()?->id)
                ->with('merchant', fn($query) => $query->select(['id', 'name']))
                ->with('brand', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('edition', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('condition', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('transmission', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('engine', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('fuel', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('skeleton', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->with('mileage', fn($query) => $query->with('translate')->select(['id', 'slug']))
                ->where('is_approved', '=', Status::INACTIVE->toString())
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return view('content.merchant.vehicle.product.show', compact('vehicles', 'merchant_id'));
    }

    public function sendMail(Request $request)
    {
        $vehicle = Vehicle::where('id', $request->id)->with('translate')->first();
        Mail::to($request->email)->send(new SendVehicleMail($vehicle));
        return back()->with('status', 'Mail Send Successfully');
    }

    public function vehicleEdit(Request $request)
    {
        if ($request->ajax()) {
            $vehicle = Vehicle::where('id', $request->vehicle_id)->with('translate')
                ->with('available')->first();

            $availables = Available::with(['translate' => function ($query) {
                $query->orderBy('title', 'asc');
            }])
                ->whereNotIn('slug', ['available-my-showroom'])
                ->orderBy('slug', 'asc')
                ->get();

            foreach ($availables as $available) {
                $selectedAvail[$available->id] = toLocaleString($available->translate);
            }
            $available = toLocaleString($vehicle?->available->translate);

            $response = [
                'availables' => $selectedAvail,
                'available' => $available,
                'vehicle' => $vehicle
            ];
            return response()->json($response);
        }
    }

    public function vehicleUpdate(Request $request, Vehicle $product)
    {
        $request->validate([
            'fixed_price' => 'required',
            'available_id' => 'required'
        ]);

        $product->update([
            'purchase_price' => $request->purchase_price,
            'fixed_price' => $request->fixed_price,
            'price' => $request->price,
            'available_id' => $request->available_id
        ]);

        return back()->with('status', 'Vehicle Update Successfully');
    }

    public function storeCustomTable(Request $request)
    {
        CustomMerchanVehicletTable::updateOrCreate([
            'merchant_id' => auth()->user()?->id,
        ], [
            'app' => $request->app ? true : false,
            'sl' => $request->sl ? true : false,
            'brand_id' => $request->brand_id ? true : false,
            'carmodel_id' =>  $request->carmodel_id ? true : false,
            'manufacture' => $request->manufacture ? true : false,
            'registration' => $request->registration ? true : false,
            'condition_id' => $request->condition_id ? true : false,
            'edition_id' => $request->edition_id ? true : false,
            'fuel_id' => $request->fuel_id ? true : false,
            'mileage_id' => $request->mileage_id ? true : false,
            'grade_id' => $request->grade_id ? true : false,
            'feature' => $request->feature ? true : false,
            'purchase_price' => $request->purchase_price ? true : false,
            'price' => $request->price ? true : false,
            'fixed_price' => $request->fixed_price ? true : false,
            'available_id' => $request->available_id ? true : false,
            'slug' => $request->slug ? true : false,
            'skeleton_id' => $request->skeleton_id ? true : false,
            'power' => $request->power ? true : false,
            'chassis_number' => $request->chassis_number ? true : false,
            'engine_number' => $request->engine_number ? true : false,
            'link' => $request->link ? true : false,
            'status' => $request->status ? true : false,
            'action' => $request->action ? true : false,
            'modified' => $request->modified ? true : false,
            'code' => $request->code ? true : false,
        ]);
        return back()->with('status', 'Custom colum added successfully');
    }

    public function storeDefaultTable(Request $request)
    {
        CustomMerchanVehicletTable::updateOrCreate([
            'merchant_id' => auth()->user()?->id,
        ], [
            'app' => true,
            'sl' => true,
            'brand_id' => true,
            'carmodel_id' =>  true,
            'manufacture' => true,
            'registration' => true,
            'condition_id' => true,
            'edition_id' => true,
            'fuel_id' => true,
            'mileage_id' => true,
            'grade_id' => true,
            'feature' => true,
            'purchase_price' => false,
            'price' => true,
            'fixed_price' => false,
            'available_id' => true,
            'slug' => false,
            'skeleton_id' => false,
            'power' => false,
            'chassis_number' => false,
            'engine_number' => false,
            'link' => false,
            'status' => false,
            'action' => false,
            'modified' => false,
            'code' => false,
        ]);
        return back()->with('status', 'Default Colum Set Successfully');
    }

    public function stockList(Request $request)
    {
        $merchant_id = base64_decode($request->input('merchant_id'));

        $price_type = $request->input('price');
        $vehicles = Vehicle::with(['vehicle_feature' => function ($query) {
            $query->with(['feature', 'detail']);
        }])->where('merchant_id', $merchant_id)->get();


        $url = route('merchant.stockList', [
            'price' => $price_type,
            'merchant_id' => $request->input('merchant_id')
        ]);

        $merchant = $vehicles->first()->merchant->merchantInfo?->company_name ?? $vehicles->first()->merchant->name;
        $message = sprintf("Stock List : %s", $merchant);
        $whatsappLink = 'https://wa.me/?text=' . urlencode($message) . '%0A' . "Click Below%0A" . urlencode($url);

        if (!empty(Auth::guard('merchant')->user()->id) && Auth::guard('merchant')->user()->id == $merchant_id) {
            return redirect($whatsappLink);
        } else {
            return view('content.merchant.vehicle.product.stock', compact('vehicles', 'price_type'));
        }
    }

    /**
     * Define public method approvals()
     * @return View|Factory|Application
     */
    public function approvals()
    {
        $custom = CustomMerchanVehicletTable::where('merchant_id', auth()->user()?->id)->first();
        $merchant_id = auth()->user('merchant')->id;
        $products = Vehicle::query()->latest()->where('merchant_id', $merchant_id)
            ->where('status', Status::INACTIVE->toString())
            ->with(['vehicle_feature' => function ($query) {
                $query->with('feature', 'detail');
            }])
            ->with('merchant', fn($query) => $query->select(['id', 'name']))
            ->with('brand', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('edition', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('condition', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('transmission', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('engine', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('fuel', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('skeleton', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('mileage', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->get();

        return view('content.merchant.vehicle.product.approvals', compact('products', 'custom'));
    }

    /**
     * Define public method approvalVehicle()
     */
    public function approvalVehicle(Vehicle $vehicle)
    {
        $vehicle->update(['status' => 1]);
        return back()->with('status', 'Product has been approved');
    }
}
