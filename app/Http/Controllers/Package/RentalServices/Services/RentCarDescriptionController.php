<?php

namespace App\Http\Controllers\Package\RentalServices\Services;

use App\Models\RentCar;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Console\Application;
use Illuminate\Console\View\Components\Factory;
use App\Http\Requests\Package\Vehicle\StoreDescriptionRequest;

class RentCarDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * @param RentCar $rentCar
     * @return RedirectResponse
     */
    public function create(RentCar $rentCar): View|Factory|Application
    {
        return view('content.package.rental-services.services.rental-car.detail', compact('rentCar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RentCar $rentCar, StoreDescriptionRequest $request)
    {
        if ($request->validated()) {
            $isManage = collect($request->input('description'))->each(fn ($each, $lang) => $rentCar->description()->updateOrCreate(['local' => $lang], ['content' => $each, 'local' => $lang]));
            $response = $isManage ? 'Congrats! Data is processed successfully' : 'Oops! Unable to process record';
            return Redirect::route('admin.rental.service.car.gallery.create', ['rentCar' => $rentCar->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
