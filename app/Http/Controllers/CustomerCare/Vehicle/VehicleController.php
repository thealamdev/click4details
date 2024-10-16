<?php

namespace App\Http\Controllers\CustomerCare\Vehicle;

use App\Models\Code;
use App\Models\Package;
use App\Models\Vehicle;
use App\Models\Available;
use App\Models\CustomerCare;
use Illuminate\Http\Request;
use App\Models\VehicleFeatur;
use App\Http\Controllers\Controller;

class VehicleController extends Controller
{
    /**
     * Define the current locale
     * @var string|null
     */
    public ?string $translate = null;

    protected $listeners = [
        'load-more' => 'loadMore',  // For loading more data on scroll down
        'updateLocaleString' => 'toTranslatorString',  // For updating the translation
    ];

    /**
     * Display a listing of the resource
     * @param  Request $request
     */
    public function index(Request $request)
    {
        $customer_care = CustomerCare::query()
            ->where('customer_cares.id', '=', $request->user('customercare')->id)
            ->leftJoin('merchants as m', 'm.id', '=', 'customer_cares.parent_id')
            ->select('m.id as m_id')
            ->first();
        $merchant_id = $customer_care->m_id;
        $products = Vehicle::query()->latest()->where('merchant_id', $merchant_id)
            ->with('translate')
            ->with(['vehicle_feature' => function ($query) {
                $query->with('feature', 'detail');
            }])
            ->with('merchant', fn ($query) => $query->select(['id', 'name']))
            ->with('available', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('grade', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('carmodel', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('brand', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('edition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('condition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('transmission', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('engine', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('fuel', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('skeleton', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('mileage', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->get();
        return view('content.customer-care.vehicles.product.index', compact('products'));
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
     * Display the resources in large view
     * @param Request $request
     */
    public function largeView(Request $request)
    {
        $customer_care = CustomerCare::query()
            ->where('customer_cares.id', '=', $request->user('customercare')->id)
            ->leftJoin('merchants as m', 'm.id', '=', 'customer_cares.parent_id')
            ->select('m.id as m_id')
            ->first();
        $merchant_id = $customer_care->m_id;
        $products = Vehicle::query()->latest()->where('merchant_id', $merchant_id)
            ->with('translate')
            ->with(['vehicle_feature' => function ($query) {
                $query->with('feature', 'detail');
            }])
            ->with('merchant', fn ($query) => $query->select(['id', 'name']))
            ->with('available', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('grade', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('carmodel', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('brand', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('edition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('condition', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('transmission', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('engine', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('fuel', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('skeleton', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('mileage', fn ($query) => $query->with('translate')->select(['id', 'slug']))
            ->get();

        return view('content.customer-care.vehicles.product.large-view', compact('products'));
    }


    /**
     * method for vehicle edit
     * @param Request $request
     */
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

    /**
     * method for update vehicle (fixed price & available)
     */
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
}
