<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Models\Vehicle;
use App\Models\Merchant;
use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\PurchaseVehicle;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;

class PurchasePriceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param Vehicle $vehicle
     * @return View|Factory|Application
     */
    public function index(Request $request, Vehicle $vehicle): View|Factory|Application
    {
        return view('content.merchant.vehicle.purchase-price.price', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return View|Factory|Application
     */
    public function create(Request $request): View|Factory|Application
    {
        return view('content.merchant.vehicle.purchase-price.create');
    }

    /**
     * Define public method directView()
     * @param Vehicle $vehicle
     * @return View|Factory|Application
     */
    public function directView(Vehicle $vehicle): View|Factory|Application
    {
        return view('content.merchant.vehicle.purchase-price.direct', compact('vehicle'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        $merchant_id = $request->user()->id;
        $merchant = Merchant::query()->where('id', $merchant_id)->first();

        if (Hash::check($request->password, $merchant->password)) {
            return response()->json([
                'status' => 200,
                'message' => 'Password matched. Proceeding to the next step.',
                'redirect_url' => route('merchant.vehicle.product.index')
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Password has not matched. Try again'
            ]);
        }
    }


    /**
     * directStore a newly created resource in storage.
     * @param Request $request
     * @param Vehicle $vehicle
     */
    public function directStore(Request $request, Vehicle $vehicle)
    {
        $merchant_id = $request->user()->id;
        $merchant = Merchant::query()->where('id', $merchant_id)->first();

        if (Hash::check($request->password, $merchant->password)) {
            return response()->json([
                'status' => 200,
                'message' => 'Password matched. Proceeding to the next step.',
                'redirect_url' => route('merchant.vehicle.purchase-price.index', ['vehicle' => $vehicle->id])
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Password has not matched. Try again'
            ]);
        }
    }

    /**
     * vehicle purchase price added route.
     * @param Request $request,
     * @param Vehicle $vehicle
     */
    public function priceStore(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'fixed_price' => 'required',
            'terms_agree' => 'required',
        ]);

        PurchaseVehicle::create($request->all());
        $vehicle->update(
            [
                'purchase_price' => $request->total_costing,
                'fixed_price' => $request->fixed_price,
                'price' => $request->selling_price,
                'status' => $request->terms_agree == 'yes' ? 1 : 0,
            ]
        );
        return back()->with('status', 'Purchase Price has been Added');
    }
}
