<?php

namespace App\Http\Controllers\Package\Residence;

use App\Models\ApartmentComplex;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Handlers\Resolvers\Package\Residence\ApartmentComplexHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Residence\StoreApartmentComplexRequest;
use App\Http\Requests\Package\Residence\UpdateApartmentComplexRequest;

class ApartmentComplexController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        $collections = ApartmentComplex::query()->get();
        return view('content.package.residence.apartment-complex.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     * @return View|Factory|Application
     */
    public function create(): View|Factory|Application
    {
        return view('content.package.residence.apartment-complex.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreApartmentComplexRequest $request
     * @param ApartmentComplexHandler $handler
     * @return RedirectResponse
     */
    public function store(StoreApartmentComplexRequest $request, ApartmentComplexHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new edition';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Show the form for editing the specified resource.
     * @param ApartmentComplex $apartmentComplex
     * @return View|Factory|Application
     */
    public function edit(ApartmentComplex $apartmentComplex): View|Factory|Application
    {
        return view('content.package.residence.apartment-complex.edit', compact('apartmentComplex'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateApartmentComplexRequest $request
     * @param ApartmentComplex $apartmentComplex
     * @param ApartmentComplexHandler $handler
     * @return RedirectResponse
     */
    public function update(UpdateApartmentComplexRequest $request, ApartmentComplex $apartmentComplex, ApartmentComplexHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $apartmentComplex);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update available resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage.
     * @param ApartmentComplex $apartmentComplex,
     * @param ApartmentComplexHandler $handler
     * @return RedirectResponse
     */
    public function destroy(ApartmentComplex $apartmentComplex, ApartmentComplexHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($apartmentComplex);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete model resource';
        return Redirect::back()->with('status', $response);
    }
}
