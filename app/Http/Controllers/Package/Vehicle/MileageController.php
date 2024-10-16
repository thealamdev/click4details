<?php

namespace App\Http\Controllers\Package\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Vehicle\MileageHandler;
use App\Http\Requests\Package\Vehicle\StoreMileageRequest;
use App\Http\Requests\Package\Vehicle\UpdateMileageRequest;
use App\Models\Mileage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MileageController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Mileage::query()->with('translate')->orderBy('slug')->get();
        return view('content.package.vehicle.mileage.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.package.vehicle.mileage.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreMileageRequest $request
     * @param  MileageHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreMileageRequest $request, MileageHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new mileage';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Mileage $mileage
     * @return void
     */
    public function show(Mileage $mileage): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Mileage                  $mileage
     * @return Application|Factory|View
     */
    public function edit(Mileage $mileage): View|Factory|Application
    {
        return view('content.package.vehicle.mileage.update', compact('mileage'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateMileageRequest $request
     * @param  Mileage              $mileage
     * @param  MileageHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateMileageRequest $request, Mileage $mileage, MileageHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $mileage);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update mileage resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Mileage          $mileage
     * @param  MileageHandler   $handler
     * @return RedirectResponse
     */
    public function destroy(Mileage $mileage, MileageHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($mileage);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete mileage resource';
        return Redirect::back()->with('status', $response);
    }
}
