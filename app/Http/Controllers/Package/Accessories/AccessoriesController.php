<?php

namespace App\Http\Controllers\Package\Accessories;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Accessory\StoreAccessoryRequest;
use App\Http\Requests\Package\Accessory\UpdateAccessoryRequest;
use App\Http\Handlers\Resolvers\Package\Accessory\AccessoryHandler;
use App\Models\Accessory;
use App\Models\AccessoryBrand;

class AccessoriesController extends Controller
{
    public function index(Request $request)
    {
        $accessory = Accessory::query()
            ->with('brand', fn ($q) => $q->with('translate'))
            ->with('translate')
            ->with('merchant', fn ($query) => $query->select(['id', 'name']))
            ->orderBy('id', 'desc')
            ->get();

        return view('content.package.accessory.product.index', compact('accessory'));
    }

    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create()
    {
        $brands = AccessoryBrand::get();
        return view('content.package.accessory.product.create', compact('brands'));
    }



    public function store(StoreAccessoryRequest $request, AccessoryHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a record';
            return Redirect::route('admin.accessory.description.index', ['accessory' => $isCreate->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }



    public function show(Property $property): void
    {
        // TODO: Implement show() method
    }


    public function edit($id)
    {
        $accessory = Accessory::with('translate')
            ->where('id', $id)
            ->first();
        return view('content.package.accessory.product.update', compact('accessory'));
    }



    public function update(UpdateAccessoryRequest $request, $id, AccessoryHandler $handler): RedirectResponse
    {
        $accessory = Accessory::with('translate')
            ->where('id', $id)
            ->first();

        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $accessory);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update vehicle resource';
            return Redirect::route('admin.accessory.description.index', ['accessory' => $accessory->getKey()])->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Vehicle          $product
     * @param  VehicleHandler   $handler
     * @return RedirectResponse
     */
    public function destroy($id, AccessoryHandler $handler): RedirectResponse
    {
        $accessory = Accessory::where('id', $id)->first();
        $isDelete = $handler->erase($accessory);
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


    public function search()
    {
        $detail = null;
        $shared = null;
        $tranlate = null;
        return view('livewire.accessory-card', ['detail' => $detail, 'shared' => $shared]);
    }
}
