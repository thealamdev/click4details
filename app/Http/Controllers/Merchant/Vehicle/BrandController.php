<?php

namespace App\Http\Controllers\Merchant\Vehicle;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\Package\Vehicle\StoreBrandRequest;
use App\Http\Requests\Package\Vehicle\UpdateBrandRequest;
use App\Http\Handlers\Resolvers\Package\Vehicle\BrandHandler;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource
     * @param  Request                  $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $collections = Brand::query()->with('translate')->latest()->get();
        return view('content.merchant.vehicle.brand.index', compact('collections'));
    }


    /**
     * Show the form for creating a new resource
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('content.merchant.vehicle.brand.create');
    }

    /**
     * Store a newly created resource in storage
     * @param  StoreBrandRequest $request
     * @param  BrandHandler      $handler
     * @return RedirectResponse
     */
    public function store(StoreBrandRequest $request, BrandHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isCreate = $handler->store($request);
            $response = $isCreate ? 'Congrats! Data is created successfully' : 'Oops! Unable to create a new brand';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to create');
    }

    /**
     * Display the specified resource
     * @param  Brand $brand
     * @return void
     */
    public function show(Brand $brand): void
    {
        // TODO: Implement show() method
    }

    /**
     * Show the form for editing the specified resource
     * @param  Brand                    $brand
     * @return Application|Factory|View
     */
    public function edit(Brand $brand): View|Factory|Application
    {
        return view('content.merchant.vehicle.brand.update', compact('brand'));
    }

    /**
     * Update the specified resource in storage
     * @param  UpdateBrandRequest $request
     * @param  Brand              $brand
     * @param  BrandHandler       $handler
     * @return RedirectResponse
     * @noinspection PhpConditionAlreadyCheckedInspection
     */
    public function update(UpdateBrandRequest $request, Brand $brand, BrandHandler $handler): RedirectResponse
    {
        if ($request->validated()) {
            $isUpdate = $handler->adapt($request, $brand);
            $response = $isUpdate ? 'Congrats! Data is updated successfully' : 'Oops! Unable to update brand resource';
            return Redirect::back()->with('status', $response);
        }
        return Redirect::back()->with('status', 'Oops! Something went wrong to updated');
    }

    /**
     * Remove the specified resource from storage
     * @param  Brand            $brand
     * @param  BrandHandler     $handler
     * @return RedirectResponse
     */
    public function destroy(Brand $brand, BrandHandler $handler): RedirectResponse
    {
        $isDelete = $handler->erase($brand);
        $response = $isDelete ? 'Congrats! Data is deleted successfully' : 'Oops! Unable to delete brand resource';
        return Redirect::back()->with('status', $response);
    }
}
