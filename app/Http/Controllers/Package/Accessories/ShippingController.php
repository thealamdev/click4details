<?php

namespace App\Http\Controllers\Package\Accessories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Support\Facades\Redirect;


class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = District::all();
        return view('content.package.accessory.shipping.index', compact('collections'));
    }


    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(District $shipping)
    {
        return view('content.package.accessory.shipping.update', compact('shipping'));
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
