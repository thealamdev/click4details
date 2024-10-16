<?php

namespace App\Http\Controllers\Package\Property;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Handlers\Resolvers\Package\Property\PropertyHandler;
use App\Http\Requests\Package\Property\StorePropertyRequest;
use App\Http\Requests\Package\Property\UpdatePropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): Application|Factory|View
    {
        $property = Property::query()
            ->with('merchant', fn($query) => $query->select(['id', 'name']))
            ->with('priceunit', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('sizeunit', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->with('type', fn($query) => $query->with('translate')->select(['id', 'slug']))
            ->paginate($request->perPage ?? 20);
        return view('content.package.property.product.index', compact('property'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): Application|Factory|View
    {
        return view('content.package.property.product.create');
    }

    /**
     * Define public method store for store resources
     * @param StorePropertyRequest $request
     * @param PropertyHandler $handler
     * @return RedirectResponse
     */
    public function store(StorePropertyRequest $request, PropertyHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a record';
            return Redirect::route('admin.property.description.index', ['property' => $isCreate->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Define public method edit to edit the page
     * @param Property $product
     * @return View|Factory|Application
     */
    public function edit(Property $product): View|Factory|Application
    {
        return view('content.package.property.product.update', compact('product'));
    }

    /**
     * Define public method update for update the resourses
     * @param UpdatePropertyRequest $request,
     * @param $id
     * @param PropertyHandler $handler
     * @return RedirectResponse
     */
    public function update(Property $product, UpdatePropertyRequest $request, PropertyHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $product);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update vehicle resource';
            return Redirect::route('admin.property.description.index', ['property' => $product->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Vehicle          $product
     * @param  VehicleHandler   $handler
     * @return RedirectResponse
     */
    public function destroy(Property $property, PropertyHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($property);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete vehicle resource';
        return Redirect::back()->with('status', $response);
    }

    /**
     * Show the form for manage product details resource
     * @return Application|Factory|View
     */
    public function detail(): View|Factory|Application
    {
        return view('content.package.property.product.detail');
    }

    /**
     * Show the form for manage product gallery resource
     * @return Application|Factory|View
     */
    public function gallery(): View|Factory|Application
    {
        return view('content.package.property.product.gallery');
    }
}
