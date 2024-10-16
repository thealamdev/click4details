<?php

namespace App\Http\Controllers\Package\RentalServices\Services;

use App\Models\Skeleton;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\UpdateSkeletonRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\SkeletonHandler;
use App\Http\Requests\Package\RentalServices\StoreRentCarRequest;
use App\Http\Handlers\Resolvers\Package\RentalServices\RentCarHandler;
use App\Http\Requests\Package\RentalServices\UpdateRentCarRequest;
use App\Models\RentCar;

class RentalCarController extends Controller
{
    /**
     * Define public property $vehicle_type
     * @var array|object
     */
    public array|object $vehicle_type = [];

    /**
     * Define public method index
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $collections = RentCar::query()->with('translate', 'brand', 'carmodel', 'color')->get();
        return view('content.package.rental-services.services.rental-car.index', compact('collections'));
    }

    /**
     * Define public method create
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        $this->vehicle_type = [
            'Private Car',
            'Hiace',
            'Bus',
            'SUV',
            'MPV',
            '4 X 4',
            'Seadan',
            'Sallon'
        ];
        return view('content.package.rental-services.services.rental-car.create', ['vehicle_type' => $this->vehicle_type]);
    }

    /**
     * Define public method store
     * @param StoreRentCarRequest $request
     * @param RentCarHandler $handler
     * @return RedirectResponse
     */
    public function store(StoreRentCarRequest $request, RentCarHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a record';
            return Redirect::route('admin.rental.service.car.description.create', ['rentCar' => $isCreate->getKey()])->with('status' . $response);
        }
    }

    /**
     * Show the form for editing the specified resource
     * @param  RentCar $rentCar
     * @return Application|Factory|View
     */
    public function edit(RentCar $rentCar): View|Factory|Application
    {
        $this->vehicle_type = [
            'Private Car',
            'Hiace',
            'Bus',
            'SUV',
            'MPV',
            '4 X 4',
            'Seadan',
            'Sallon'
        ];
        return view('content.package.rental-services.services.rental-car.edit', ['rentCar' => $rentCar, 'vehicle_type' => $this->vehicle_type]);
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateSkeletonRequest $request
     * @param  Skeleton              $skeleton
     * @param  SkeletonHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateRentCarRequest $request, RentCar $rentCar, RentCarHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $rentCar);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update rent car resource';
            return Redirect::route('admin.rental.service.car.description.create', ['rentCar' => $rentCar->getKey()])->with('status' . $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Skeleton         $skeleton
     * @param  SkeletonHandler  $handler
     * @return RedirectResponse
     */
    public function destroy(RentCar $rentCar, RentCarHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($rentCar);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete  rent car resource';
        return Redirect::back()->with('status', $response);
    }
}
