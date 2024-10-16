<?php

namespace App\Http\Controllers\Package\Accessories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Handlers\Resolvers\Package\Accessory\BrandHandler;
use App\Http\Requests\Package\Accessory\StoreAccessoryBrandRequest;
use App\Models\AccessoryBrand;
use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Support\Facades\Redirect;


class AccessoryBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = AccessoryBrand::query()->with('translate')->latest()->paginate($request->perPage ?? 10);
        return view('content.package.accessory.brand.index', compact('collections'));
    }

    public function create()
    {
        return view('content.package.accessory.brand.create');
    }

    public function store(StoreAccessoryBrandRequest $request, BrandHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new edition';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }


    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(AccessoryBrand $brand)
    {
        return view('content.package.accessory.brand.update', compact('brand'));
    }


    public function update(Request $request, $shipping)
    {
        $update_shipping = District::find($shipping);
        $update_shipping->update([
            'charge' => $request->charge,
            'status' => $request->status,
        ]);
        return Redirect::back()->with('status', "Data update successfully");
    }
}
