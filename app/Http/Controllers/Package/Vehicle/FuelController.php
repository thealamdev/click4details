<?php

namespace App\Http\Controllers\Package\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\FuelHandler;
use App\Http\Requests\Package\Vehicle\StoreFuelRequest;
use App\Http\Requests\Package\Vehicle\UpdateFuelRequest;
use App\Models\Fuel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Application|Factory
    {
        $collections = Fuel::query()->with('translate')->orderBy('slug')->get();
        return view('content.package.vehicle.fuel.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.package.vehicle.fuel.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreFuelRequest $request
     * @param  FuelHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreFuelRequest $request, FuelHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new fuel resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fuel $fuel)
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Fuel                     $fuel
     * @return Application|Factory|View
     */
    public function edit(Fuel $fuel): View|Application|Factory
    {
        return view('content.package.vehicle.fuel.update', compact('fuel'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateFuelRequest $request
     * @param  Fuel              $fuel
     * @param  FuelHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateFuelRequest $request, Fuel $fuel, FuelHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $fuel);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update fuel resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Fuel             $fuel
     * @param  FuelHandler      $handler
     * @return RedirectResponse
     */
    public function destroy(Fuel $fuel, FuelHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($fuel);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete fuel resource';
        return Redirect::back()->with('status', $response);
    }
}
