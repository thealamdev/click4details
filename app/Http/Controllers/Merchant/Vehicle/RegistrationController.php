<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Package\Vehicle\StoreRegistrationRequest;
use App\Http\Requests\Package\Vehicle\UpdateRegistrationRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\RegistrationtHandler;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $collections = Registration::query()->with('translate')->get();
        return view('content.merchant.vehicle.registration.index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('content.merchant.vehicle.registration.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrationRequest $request, RegistrationtHandler $handler):RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new edition';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

       
    /**
     * Display the specified resource
     * @param  Condition $condition
     * @return void
     */
    public function show(Registration $registration): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Condition                $condition
     * @return Application|Factory|View
     */
    public function edit(Registration $registration)
    {
        return view('content.merchant.vehicle.registration.update', compact('registration'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateConditionRequest $request
     * @param  Condition              $condition
     * @param  ConditionHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateRegistrationRequest $request, Registration $registration, RegistrationtHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $registration);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update registration resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Condition        $condition
     * @param  ConditionHandler $handler
     * @return RedirectResponse
     */
    public function destroy(Registration $registration, RegistrationtHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($registration);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
