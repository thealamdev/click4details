<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\TransmissionHandler;
use App\Http\Requests\Package\Vehicle\StoreTransmissionRequest;
use App\Http\Requests\Package\Vehicle\UpdateTransmissionRequest;
use App\Models\Transmission;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransmissionController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Transmission::query()->with('translate')->get();
        return view('content.merchant.vehicle.transmission.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.merchant.vehicle.transmission.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreTransmissionRequest $request
     * @param  TransmissionHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreTransmissionRequest $request, TransmissionHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a record';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Transmission $transmission
     * @return void
     */
    public function show(Transmission $transmission): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Transmission             $transmission
     * @return Application|Factory|View
     */
    public function edit(Transmission $transmission): View|Factory|Application
    {
        return view('content.merchant.vehicle.transmission.update', compact('transmission'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateTransmissionRequest $request
     * @param  Transmission              $transmission
     * @param  TransmissionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateTransmissionRequest $request, Transmission $transmission, TransmissionHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $transmission);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update transmission resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Transmission        $transmission
     * @param  TransmissionHandler $handler
     * @return RedirectResponse
     */
    public function destroy(Transmission $transmission, TransmissionHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($transmission);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete transmission resource';
        return Redirect::back()->with('status', $response);
    }
}
