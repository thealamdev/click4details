<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Models\Vehicle;
use App\Models\Description;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreDescriptionRequest;
use App\Http\Requests\Package\Vehicle\UpdateDescriptionRequest;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Vehicle                  $vehicle
     * @return Application|Factory|View
     */
    public function index(Vehicle $vehicle): View|Factory|Application
    {
        return view('content.merchant.vehicle.product.detail', compact('vehicle'));
    }

    /**
     * Show the form for creating a new resource
     * @param  Vehicle $vehicle
     * @return void
     */
    public function create(Vehicle $vehicle): void
    {
        // TODO: Implement create() method
    }

    /**
     * Store a newly created resource in storage
     * @param  Vehicle                 $vehicle
     * @param  StoreDescriptionRequest $request
     * @return RedirectResponse
     */
    public function store(Vehicle $vehicle, StoreDescriptionRequest $request): RedirectResponse
    {
        if ($request->validated()) {
            $isManage = collect($request->input('description'))->each(fn ($each, $lang) => $vehicle->description()->updateOrCreate(['local' => $lang], ['content' => $each, 'local' => $lang]));
            $response = $isManage ? 'Congrats! Data is processed successfully' : 'Oops! Unable to process record';
            return Redirect::route('merchant.vehicle.gallery.index', ['vehicle' => $vehicle->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Vehicle     $vehicle
     * @param  Description $description
     * @return void
     */
    public function show(Vehicle $vehicle, Description $description): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Vehicle     $vehicle
     * @param  Description $description
     * @return void
     */
    public function edit(Vehicle $vehicle, Description $description): void
    {
        // TODO: Implement edit() method
    }

    /**
     * Update the specified resource in storage
     * @param  Vehicle                  $vehicle
     * @param  UpdateDescriptionRequest $request
     * @param  Description              $description
     * @return void
     */
    public function update(Vehicle $vehicle, UpdateDescriptionRequest $request, Description $description): void
    {
        // TODO: Implement update() method
    }

    /**
     * Remove the specified resource from storage
     * @param  Vehicle     $vehicle
     * @param  Description $description
     * @return void
     */
    public function destroy(Vehicle $vehicle, Description $description): void
    {
        // TODO: Implement destroy() method
    }
}
